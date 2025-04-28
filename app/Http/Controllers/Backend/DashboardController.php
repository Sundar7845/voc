<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Branches;
use App\Models\Customer;
use App\Models\WalkinCustomer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard()
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

    function liveUserShowroomRecord(Request $request)
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
        $customerDetails = WalkinCustomer::where('customer_id', $id)
            ->orderBy('created_at', 'desc') // latest first
            ->skip(1) // skip the most recent
            ->take(1) // get the one before that
            ->first();

        return view('backend.customerdetails', compact('customerDetails'));
    }
}
