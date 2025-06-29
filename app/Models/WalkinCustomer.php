<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalkinCustomer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'branch_id',
        'daily_count',
        'sales_executive_id',
        'customer_enter_time',
        'customer_out_time',
        'is_purchased',
        'is_scheme_redemption',
        'is_scheme_joining',
        'jewellery_review',
        'pricing_review',
        'staff_review',
        'service_review',
        'assit_review',
        'non_purchased_review',
        'non_purchased_others',
        'spent_time'
    ];
}
