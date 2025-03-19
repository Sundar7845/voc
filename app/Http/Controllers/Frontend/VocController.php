<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\WalkinCustomer;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VocController extends Controller
{
    function voc(Request $request)
    {
        $todayCount = WalkinCustomer::whereDate('customer_enter_time', Carbon::today())->count();
        $formattedCount = str_pad($todayCount == 0 ? 1 : $todayCount, 3, '0', STR_PAD_LEFT);


        $walkincustomer = WalkinCustomer::get();
        return view('frontend.voc', compact('walkincustomer', 'formattedCount'));
    }

    function customerCreate(Request $request)
    {
        try {
            $customer = Customer::where('phone_number', $request->phone)->first();
            if ($customer) {
                WalkinCustomer::Create([
                    'customer_id' => $customer->id,
                    'branch_id' => Auth::user()->id,
                    'customer_enter_time' => Carbon::now()
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Customer found and Walkin record created successfully.'
                ]);
            } else {
                $newCustomer = Customer::Create([
                    'customer_id' => null,
                    'phone_number' => $request->phone
                ]);

                WalkinCustomer::Create([
                    'customer_id' => $newCustomer->id,
                    'branch_id' => Auth::user()->id,
                    'customer_enter_time' => Carbon::now()
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'New customer created and Walkin record added successfully.'
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
}
