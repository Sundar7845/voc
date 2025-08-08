<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Profession;
use App\Models\SalesReport;
use App\Models\WalkinCustomer;
use App\Traits\Common;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class VocController extends Controller
{
    use Common;

    public function voc(Request $request)
    {
        // ✅ Handle AJAX request for Birthday Customers FIRST
        if ($request->ajax() && $request->type === 'birthday') {
            try {
                $bdaydate = $request->bdaydate
                    ? Carbon::parse($request->bdaydate)
                    : Carbon::today();

                $birthdayCustomers = Customer::join('branches', 'customers.branch_id', '=', 'branches.id')
                    ->where('customers.branch_id', Auth::user()->branch_id)
                    ->whereMonth('customers.dob', $bdaydate->month)
                    ->whereDay('customers.dob', $bdaydate->day)
                    ->select('customers.*', 'branches.branch_name')
                    ->get();

                return DataTables::of($birthdayCustomers)
                    ->addColumn('dob', fn($row) => Carbon::parse($row->dob)->format('d-m-Y'))
                    ->make(true);
            } catch (Exception $e) {
                return response()->json(['error' => 'Server Error: ' . $e->getMessage()], 500);
            }
        }
        // ✅ Handle AJAX request for Anniversary Customers FIRST
        if ($request->ajax() && $request->type === 'anniversary') {
            try {
                $anniversarydate = $request->anniversarydate
                    ? Carbon::parse($request->anniversarydate)
                    : Carbon::today();

                $anniversaryCustomers = Customer::join('branches', 'customers.branch_id', '=', 'branches.id')
                    ->where('customers.branch_id', Auth::user()->branch_id)
                    ->whereMonth('customers.anniversary_date', $anniversarydate->month)
                    ->whereDay('customers.anniversary_date', $anniversarydate->day)
                    ->select('customers.*', 'branches.branch_name')
                    ->get();

                return DataTables::of($anniversaryCustomers)
                    ->addColumn('anniversary', fn($row) => Carbon::parse($row->anniversary)->format('d-m-Y'))
                    ->make(true);
            } catch (Exception $e) {
                return response()->json(['error' => 'Server Error: ' . $e->getMessage()], 500);
            }
        }

        // ✅ 2. Generic showroom AJAX
        if ($request->ajax()) {
            $date = $request->date
                ? Carbon::parse($request->date)->toDateString()
                : Carbon::today()->toDateString();

            $showroom = WalkinCustomer::select(
                'walkin_customers.*',
                'customers.name',
                'customers.phone_number',
                'customers.customer_id',
                'customers.id as customerid',
                'branches.branch_name',
                'employees.name as sales_executive_name'
            )
                ->leftJoin('customers', 'customers.id', '=', 'walkin_customers.customer_id')
                ->leftJoin('branches', 'branches.id', '=', 'walkin_customers.branch_id')
                ->leftJoin('employees', 'employees.id', '=', 'walkin_customers.sales_executive_id')
                ->where('walkin_customers.branch_id', Auth::user()->branch_id)
                ->whereNotNull('walkin_customers.customer_out_time')
                ->whereDate('walkin_customers.customer_enter_time', $date)
                ->get();

            return DataTables::of($showroom)
                ->addColumn('is_purchased', fn($row) => $row->is_purchased == 1 ? 'Purchased' : 'Non Purchased')
                ->addColumn('customer_in', fn($row) => $row->customer_enter_time ?? '-')
                ->addColumn('customer_out', fn($row) => $row->customer_out_time ?? '-')
                ->addColumn('spent_time', function ($row) {
                    if ($row->customer_enter_time && $row->customer_out_time) {
                        $start = Carbon::parse($row->customer_enter_time);
                        $end = Carbon::parse($row->customer_out_time);
                        return $start->diff($end)->format('%H:%I:%S');
                    }
                    return '-';
                })
                ->addColumn('daily_count', fn($row) => 1)
                ->addColumn('is_scheme_redemption', fn($row) => $row->is_scheme_redemption == 1 ? 'Yes' : 'No')
                ->addColumn('is_scheme_joining', fn($row) => $row->is_scheme_joining == 1 ? 'Yes' : 'No')
                ->make(true);
        }

        // ✅ Non-AJAX page load
        $walkincustomer = WalkinCustomer::select('walkin_customers.*', 'customers.name')
            ->join('customers', 'customers.id', 'walkin_customers.customer_id')
            ->whereDate('walkin_customers.customer_enter_time', Carbon::today())
            ->where('walkin_customers.branch_id', Auth::user()->branch_id)
            ->whereNull('walkin_customers.customer_out_time')
            ->orderBy('walkin_customers.customer_enter_time')
            ->get();

        $professions = Profession::where('is_active', 1)->get();
        $branch = Branches::where('branch_name', Auth::user()->name)->value('id');
        $employee = Employee::where('branch_id', Auth::user()->branch_id)
            ->where('is_active', 1)
            ->orderBy('name', 'ASC')
            ->get();

        return view('frontend.voc', compact('walkincustomer', 'professions', 'employee'));
    }


    public function getPassedHistory(Request $request)
    {
        // Get customer info
        $customer = Customer::findOrFail($request->id);
        // Get all walk-in customers for the customer (except the latest one)
        $walkins = WalkinCustomer::select('walkin_customers.*', 'customers.name', 'customers.customer_id')
            ->join('customers', 'customers.id', '=', 'walkin_customers.customer_id')
            ->where('customers.phone_number', $customer->phone_number)
            ->orderBy('walkin_customers.created_at', 'desc')
            ->get();

        $walkincustomers = $walkins->count() > 1 ? $walkins->slice(0, -1) : $walkins;

        // Get all sales reports for that customer
        $salesreports = SalesReport::with('customer')
            ->select('sales_reports.*', 'branches.branch_name')
            ->join('branches', 'branches.id', 'sales_reports.branch_id')
            ->where('sales_reports.cust_phone', $customer->phone_number)
            ->get();

        // Attach walk-in review data (if exists) to the sales reports sequentially
        $enhancedReports = collect();
        $walkinIndex = 0;


        foreach ($salesreports as $report) {
            if (isset($walkincustomers[$walkinIndex])) {
                $walkin = $walkincustomers[$walkinIndex];
                $report->jewellery_review = $walkin->jewellery_review;
                $report->assit_review = $walkin->assit_review;
                $report->staff_review = $walkin->staff_review;
                $report->pricing_review = $walkin->pricing_review;
                $report->walkin_customer = $walkin;
                $walkinIndex++;
            }
            $enhancedReports->push($report);
        }

        // Group by invoice date in d-m-Y format
        $salesreport = $enhancedReports->groupBy(function ($item) {
            return Carbon::createFromFormat('y-M-d', $item->invoice_date)->format('Y-M-d');
        });

        return response()->json([
            'status' => 'success',
            'response' => $salesreport,
            'customer' => $customer,
        ]);
    }

    function customerCreate(Request $request)
    {
        try {
            $customer = Customer::where('phone_number', $request->phone)->first();

            if ($customer) {
                // Check if there's an existing walk-in without customer_out_time
                $existingWalkin = WalkinCustomer::where('customer_id', $customer->id)
                    ->where('branch_id', Auth::user()->branch_id)
                    ->whereNull('customer_out_time')
                    ->exists();

                if (!$existingWalkin) {
                    $dailyCount = $this->getDailyCount(); // Fetch the latest count
                    WalkinCustomer::Create([
                        'customer_id' => $customer->id,
                        'branch_id' => Auth::user()->branch_id,
                        'customer_enter_time' => Carbon::now(),
                        'daily_count' => $dailyCount,
                    ]);

                    return response()->json([
                        'status' => 'success',
                        'message' => 'Customer found and Walk-in record created successfully.'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Customer already has an active Walk-in record.'
                    ]);
                }
            } else {
                // Create a new customer and walk-in record
                $newCustomer = Customer::Create([
                    'customer_id' => null,
                    'branch_id' => Auth::user()->branch_id,
                    'phone_number' => $request->phone
                ]);

                $dailyCount = $this->getDailyCount(); // Fetch the latest count

                WalkinCustomer::Create([
                    'customer_id' => $newCustomer->id,
                    'branch_id' => Auth::user()->branch_id,
                    'customer_enter_time' => Carbon::now(),
                    'daily_count' => $dailyCount,
                ]);

                return response()->json([
                    'status' => 'success',
                    'customerId' => $newCustomer->id,
                    'message' => 'New customer created and Walk-in record added successfully.'
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            $this->Log(__FUNCTION__, "POST", $e->getMessage(), Auth::user()->id, request()->ip(), gethostname());
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!',
            ], 500);
        }
    }

    private function getDailyCount()
    {
        $lastCount = WalkinCustomer::whereDate('customer_enter_time', Carbon::today())
            ->where('branch_id', Auth::user()->branch_id)
            ->orderBy('daily_count', 'desc')
            ->value('daily_count');

        return $lastCount ? str_pad((int)$lastCount + 1, 3, '0', STR_PAD_LEFT) : '001';
    }

    function getCustomerDetails(Request $request)
    {
        try {
            $customer = Customer::where('id', $request->customer_id)->first();

            if ($customer) {
                return response()->json([
                    'status' => 'success',
                    'data' => $customer
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Customer not found'
                ]);
            }
        } catch (Exception $e) {
            $this->Log(__FUNCTION__, "POST", $e->getMessage(), Auth::user()->id, request()->ip(), gethostname());
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!',
            ], 500);
        }
    }

    function customerDetailsUpdate(Request $request, $id)
    {
        try {
            Customer::where('id', $id)->update([
                'name' => $request->name,
                'phone_number' => $request->phone,
                'email' => $request->email,
                'gender' => $request->gender,
                'dob' => $request->dob,
                'martial_status' => $request->martial_status,
                'anniversary_date' => $request->anniversary_date,
                'profession_id' => $request->profession_id,
                'address' => $request->address,
                'address_line_1' => $request->address2,
                'pincode'  => $request->pincode,
                'know_about' => $request->know_about,
                'know_about_others' => $request->know_about_others,

            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Customer updated successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            $this->Log(__FUNCTION__, "POST", $e->getMessage(), Auth::user()->id, request()->ip(), gethostname());
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!',
            ], 500);
        }
    }

    function getPurchasedFeedback(Request $request, $id)
    {
        try {
            $branch = Auth::user()->branch_id;
            WalkinCustomer::where('id', $id)->update([
                // 'customer_id' => $id,
                'branch_id' => $branch,
                'sales_executive_id' => $request->salesExcutiveName,
                'customer_out_time' => Carbon::now(),
                'is_purchased' => $request->customerType,
                'non_purchased_review' => $request->customerType,
                'non_purchased_others' => $request->non_purchased_others,
                'jewellery_review' => $request->customerType == 0 || $request->customerType == 2 || $request->customerType == 3 ? 0 : $request->jewellery,
                'pricing_review' => $request->customerType == 0 || $request->customerType == 2 || $request->customerType == 3 ? 0 : $request->pricing,
                'staff_review' => $request->customerType == 0 || $request->customerType == 2 || $request->customerType == 3 ? 0 : $request->staff,
                'service_review' => $request->customerType == 0 || $request->customerType == 2 || $request->customerType == 3 ? 0 : $request->knowledge,
                'assit_review' => $request->customerType == 0 || $request->customerType == 2 || $request->customerType == 3 ? 0 : $request->assit,
                'spent_time' => $request->spentTime,
                'is_scheme_redemption' => $request->customerType == 0 || $request->customerType == 1 || $request->customerType == 2 || $request->customerType == 3 ? 0 : $request->scheme,
                'is_scheme_joining' => $request->customerType == 0 || $request->customerType == 1 || $request->customerType == 2 ? 0 : 1
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Feedback updated successfully.'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            $this->Log(__FUNCTION__, "POST", $e->getMessage(), Auth::user()->id, request()->ip(), gethostname());
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!',
            ], 500);
        }
    }
}
