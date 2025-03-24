<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'name',
        'phone_number',
        'gender',
        'email',
        'dob',
        'martial_status',
        'anniversary_date',
        'profession_id',
        'qualfication_id',
        'address',
        'pincode'
    ];
}
