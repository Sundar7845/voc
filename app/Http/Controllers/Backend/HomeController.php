<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use App\Models\Customer;
use App\Models\SalesReport;
use App\Models\WalkinCustomer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function dashboard()
    {
        $totalcustomers = Customer::count();
        $walkincustomer = WalkinCustomer::join('customers', 'customers.id', 'walkin_customers.customer_id')
            ->whereDate('walkin_customers.customer_enter_time', Carbon::today())
            ->whereNull('walkin_customers.customer_out_time')
            ->count();

        $purchasedCustomer = WalkinCustomer::join('customers', 'customers.id', 'walkin_customers.customer_id')
            ->whereDate('walkin_customers.customer_enter_time', Carbon::today())
            ->where('is_purchased', 1)
            ->whereNotNull('walkin_customers.customer_out_time')
            ->count();

        $nonPurchasedCustomer = WalkinCustomer::join('customers', 'customers.id', 'walkin_customers.customer_id')
            ->whereDate('walkin_customers.customer_enter_time', Carbon::today())
            ->where('is_purchased', 0)
            ->whereNotNull('walkin_customers.customer_out_time')
            ->count();

        return view('backend.dashboard', compact('totalcustomers', 'walkincustomer', 'purchasedCustomer', 'nonPurchasedCustomer'));
    }

    public function getShowroomRecord(Request $request)
    {
        // Get selected branch IDs
        $branchIds = Branches::whereIn('branch_name', $request->selectedShowrooms)
            ->pluck('id')
            ->toArray();

        // Total customers in selected branches
        $totalcustomers = Customer::whereIn('branch_id', $branchIds)->count();

        // Walk-in customers for selected branches on the given date with no out time
        $walkincustomer = WalkinCustomer::where(function ($query) use ($request, $branchIds) {
            $query->whereDate('customer_enter_time', $request->date)
                ->whereIn('branch_id', $branchIds);
        })
            ->whereNull('customer_out_time')
            ->count();

        // Purchased customers
        $purchasedCustomer = WalkinCustomer::where(function ($query) use ($request, $branchIds) {
            $query->whereDate('customer_enter_time', $request->date)
                ->whereIn('branch_id', $branchIds);
        })
            ->whereNotNull('customer_out_time')
            ->where('is_purchased', 1)
            ->count();

        // Non-purchased customers
        $nonPurchasedCustomer = WalkinCustomer::where(function ($query) use ($request, $branchIds) {
            $query->whereDate('customer_enter_time', $request->date)
                ->whereIn('branch_id', $branchIds);
        })
            ->where('is_purchased', 0)
            ->whereNotNull('customer_out_time')
            ->count();

        return response()->json([
            'totalcustomers' => $totalcustomers,
            'walkincustomer' => $walkincustomer,
            'purchasedCustomer' => $purchasedCustomer,
            'nonPurchasedCustomer' => $nonPurchasedCustomer,
        ]);
    }

    public function liveUserShowroomRecord(Request $request)
    {
        // Get selected branch IDs
        $branchIds = Branches::whereIn('branch_name', $request->selectedShowrooms)
            ->pluck('id')
            ->toArray();

        // Walk-in customers for selected branches on the given date with no out time
        $branchesData = WalkinCustomer::select('walkin_customers.*', 'customers.name', 'branches.branch_name')
            ->join('customers', 'customers.id', 'walkin_customers.customer_id')
            ->join('branches', 'branches.id', 'walkin_customers.branch_id')
            ->whereDate('walkin_customers.customer_enter_time', Carbon::today())
            ->whereIn('walkin_customers.branch_id', $branchIds)
            ->whereNull('walkin_customers.customer_out_time')
            ->get();

        return response()->json([
            'branchesData' => $branchesData, // where this is a properly structured array
        ]);
    }

    public function liveUser()
    {
        $branchesData = WalkinCustomer::select('walkin_customers.*', 'customers.name', 'branches.branch_name')
            ->join('customers', 'customers.id', 'walkin_customers.customer_id')
            ->join('branches', 'branches.id', 'walkin_customers.branch_id')
            ->whereDate('walkin_customers.customer_enter_time', Carbon::today())
            ->whereNotNull('walkin_customers.branch_id')
            ->whereNull('walkin_customers.customer_out_time')
            ->get();

        // Group by branch name
        $groupedData = $branchesData->groupBy('branch_name');

        return view('backend.liveuser', compact('groupedData'));
    }

    public function customerDetails($id)
    {
        // Get the second latest walk-in customer (skip latest, get second)
        $customerDetails = WalkinCustomer::where('customer_id', $id)
            ->orderBy('created_at', 'desc')
            ->skip(1)
            ->take(1)
            ->first();

        // Get customer info
        $customer = Customer::findOrFail($id);

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

        return view('backend.customerdetails', compact('customerDetails', 'salesreport'));
    }


    public function getFeedback(Request $request)
    {
        $walkincustomer = WalkinCustomer::where('id', $request->id)->first();
        return response()->json([
            'walkin_customer' => $walkincustomer
        ]);
    }

    // function getSalesReportData($id)
    // {
    //     $customer = Customer::where('id', $id)->first();
    //     $salesreport = SalesReport::select('sales_reports.*', 'branches.branch_name')
    //         ->join('branches', 'branches.id', 'sales_reports.branch_id')
    //         ->where('sales_reports.cust_phone', $customer->phone_number)
    //         ->orderBy('sales_reports.invoice_date', 'ASC')
    //         ->get();

    //     return datatables()->of($salesreport)->toJson();
    // }
}
