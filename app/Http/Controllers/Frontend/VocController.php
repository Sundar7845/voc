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

class VocController extends Controller
{
    use Common;
    function voc(Request $request)
    {
        $walkincustomer = WalkinCustomer::select('walkin_customers.*', 'customers.name')
            ->join('customers', 'customers.id', 'walkin_customers.customer_id')
            ->whereDate('walkin_customers.customer_enter_time', Carbon::today())
            ->where('walkin_customers.branch_id', Auth::user()->branch_id)
            ->whereNull('walkin_customers.customer_out_time')
            ->orderBy('walkin_customers.customer_enter_time') // Ensure proper order
            ->get();

        $professions = Profession::where('is_active', 1)->get();
        $branch = Branches::where('branch_name', Auth::user()->name)->value('id');
        $employee = Employee::where('branch_id', $branch)->orderBy('name', 'ASC')->get();
        return view('frontend.voc', compact('walkincustomer', 'professions', 'employee'));
    }

    public function getPassedHistory(Request $request)
    {
        // Get customer info
        $customer = Customer::findOrFail($request->id);

        // Get all walk-in customers for the customer (except the latest one)
        $walkincustomers = WalkinCustomer::select('walkin_customers.*', 'customers.name')
            ->join('customers', 'customers.id', 'walkin_customers.customer_id')
            ->where('customers.phone_number', $customer->phone_number)
            ->orderBy('walkin_customers.created_at', 'desc')
            ->get()
            ->slice(0, -1); // Skip the latest walk-in entry

        // Get all sales reports for that customer
        $salesreports = SalesReport::select('sales_reports.*', 'branches.branch_name')
            ->join('branches', 'branches.id', 'sales_reports.branch_id')
            ->where('sales_reports.cust_phone', $customer->phone_number)
            ->get();

        // Match walk-in records to sales reports by date
        $matchedReports = collect();

        foreach ($walkincustomers as $walkin) {
            if (!$walkin->customer_enter_time) {
                continue; // Skip entries without a date
            }

            // Format walk-in date to match sales report invoice date format
            $walkinDate = Carbon::parse($walkin->customer_enter_time)->format('y-M-d');

            // Match sales reports by invoice date
            $matches = $salesreports->filter(function ($report) use ($walkinDate) {
                return $report->invoice_date === $walkinDate;
            });

            // Attach walk-in review data to matched sales reports
            foreach ($matches as $match) {
                $match->jewellery_review = $walkin->jewellery_review;
                $match->assit_review = $walkin->assit_review;
                $match->staff_review = $walkin->staff_review;
                $match->pricing_review = $walkin->pricing_review;
                $match->walkin_customer = $walkin; // Optional full walk-in object
                $matchedReports->push($match);
            }
        }

        // Group matched reports by invoice date in 'd-m-Y' format
        $salesreport = $matchedReports->groupBy(function ($item) {
            return Carbon::createFromFormat('y-M-d', $item->invoice_date)->format('d-m-Y');
        });

        return response()->json([
            'status' => 'success',
            'response' => $salesreport
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
            $branch = Branches::where('branch_name', Auth::user()->name)->value('id');
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
                'is_scheme_redemption' => $request->customerType == 0 || $request->customerType == 2 || $request->customerType == 3 ? 0 : $request->scheme,
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
