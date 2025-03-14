<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesReport extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'branch_id',
        'invoice_date',
        'purchase_location',
        'article_code',
        'name',
        'sku_number',
        'sales_id',
        'sales_person',
        'invoice_id',
        'grweight',
        'pcs',
        'net_chargeable',
        'sales_qty',
        'ct_wght',
        'textbox_33',
        'customer_id',
        'cust_name',
        'cust_phone',
        'delivery_name',
        'sales_price',
        'cvalue',
        'stud_value',
        'mk_code',
        'sale_calc_type',
        'amt_1',
        'mk_rate',
        'mk_value',
        'makingdisper',
        'makingdisc',
        'scheme_discount',
        'textbox_89',
        'tax_item_group',
        'tax_per',
        'tax_amount',
        'total_amount',
        'line_amount',
        'invoice_amount',
        'buyer_tin'
    ];
}
