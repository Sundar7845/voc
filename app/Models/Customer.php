<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'branch_id',
        'customer_enter_time',
        'customer_out_time',
        'name',
        'phone_number',
        'email',
        'dob',
        'martial_status',
        'anniversary_date',
        'profession_id',
        'educational_qualification_id',
        'address',
        'pincode',
        'know_about',
        'is_purchased',
        'store_experience_review',
        'jewellery_review',
        'pricing_review',
        'satification_review',
        'friendly_review',
        'knowledge_review',
        'assit_review',
        'non-purchased_review'
    ];
}
