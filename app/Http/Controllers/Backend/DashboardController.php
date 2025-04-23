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
            ->whereNull('walkin_customers.customer_out_time')
            ->count();

        $nonPurchasedCustomer = WalkinCustomer::join('customers', 'customers.id', 'walkin_customers.customer_id')
            ->whereDate('walkin_customers.customer_enter_time', Carbon::today())
            ->where('is_purchased', 1)
            ->whereNull('walkin_customers.customer_out_time')
            ->count();

        return view('backend.dashboard', compact('totalcustomers', 'walkincustomer', 'purchasedCustomer', 'nonPurchasedCustomer'));
    }

    function liveUser()
    {
        $branches = WalkinCustomer::select('walkin_customers.*','customers.name','branches.branch_name')->join('customers', 'customers.id', 'walkin_customers.customer_id')
        ->join('branches', 'branches.id', 'walkin_customers.branch_id')
            ->whereDate('walkin_customers.customer_enter_time', Carbon::today())
            ->where('walkin_customers.branch_id', '!=', null)
            ->whereNull('walkin_customers.customer_out_time')
            ->get();
            // dd($branches);
        return view('backend.liveuser', compact('branches'));
    }
    public function customerDetails($id)
    {
        return view('backend.customerdetails', [
            'customerId' => $id,
        ]);
    }
}
