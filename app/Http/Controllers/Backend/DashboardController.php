<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function dashboard()
    {
        return view('backend.dashboard');
    }

    function liveUser()
    {
        return view('backend.liveuser');
    }
    public function customerDetails($id)
    {
        return view('backend.customerdetails', [
            'customerId' => $id,
        ]);
    }
}
