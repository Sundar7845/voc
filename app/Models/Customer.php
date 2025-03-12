<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'STORE',
        'NAME',
        'GENDER',
        'CUSTOMER_ID',
        'MOBILE_NUMBER',
        'DATE_OF_BIRTH',
        'E-MAIL_ID',
        'AGE',
        'MARITAL_STATUS',
        'ANNIVERSARY_DATE',
        'EDUCATIONAL_QUALIFICATION',
        'PROFESSION',
        'LAST_VISIT_DATE',
        'SALES_PERSON_HANDLED'
    ];
}
