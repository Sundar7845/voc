<?php

namespace App\Traits;

use App\Models\Log;
use Carbon\Carbon;

trait Common
{
    public function Log($transaction_name, $mode, $log_message, $user_id, $ip_address, $system_name)
    {
        Log::create([
            'transaction_name' => $transaction_name,
            'mode' => $mode,
            'log_message' => $log_message,
            'user_id' => $user_id,
            'ip_address' => $ip_address,
            'system_name' =>  $system_name,
            'log_date' => Carbon::now()
        ]);
    }
}