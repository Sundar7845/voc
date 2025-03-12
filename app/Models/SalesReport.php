<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesReport extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'INVENTLOCATIONID1',
        'INVOICEDATE',
        'INVENTLOCATIONID',
        'DIMENSION2_',
        'ARTICLECODE',
        'NAME',
        'NAMEALIAS1',
        'SKUNUMBER',
        'SALESID',
        'SalesPerson',
        'REFCUSTORDERID',
        'REFAPPROVALSALESIDDTH',
        'GOPAS',
        'INVOICEID',
        'GRWEIGHT',
        'PCS',
        'NETCHARGERABLE',
        'SALESQTY',
        'CtWght',
        'Textbox33',
        'ORDERACCOUNT',
        'DELIVERYNAME',
        'CELLULARPHONE',
        'SALESPRICE',
        'CVALUE',
        'STUDDVALUE',
        'MKCODE',
        'SALECALCTYPE',
        'AMT1',
        'MKRATE',
        'MKVALUE',
        'MAKINGDISCPER',
        'MAKINGDISC',
        'SCHEMEDISCOUNT',
        'Textbox89',
        'TAXITEMGROUP',
        'TAXPER',
        'TAXAMOUNT',
        'TOTALAMOUNT',
        'LINEAMOUNT',
        'INVOICEAMOUNT',
        'BuyerTIN',
        'NARRATION'
    ];
}
