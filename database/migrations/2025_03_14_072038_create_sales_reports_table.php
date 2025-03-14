<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('purchase_location')->nullable();
            $table->string('article_code')->nullable();
            $table->string('name')->nullable();
            $table->string('sku_number')->nullable();
            $table->string('sales_id')->nullable();
            $table->string('sales_person')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('grweight')->nullable();
            $table->string('pcs')->nullable();
            $table->string('net_chargeable')->nullable();
            $table->string('sales_qty')->nullable();
            $table->string('ct_wght')->nullable();
            $table->string('textbox_33')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('cust_name')->nullable();
            $table->string('cust_phone')->nullable();
            $table->string('delivery_name')->nullable();
            $table->string('sales_price')->nullable();
            $table->string('cvalue')->nullable();
            $table->string('stud_value')->nullable();
            $table->string('mk_code')->nullable();
            $table->string('sale_calc_type')->nullable();
            $table->string('amt_1')->nullable();
            $table->string('mk_rate')->nullable();
            $table->string('mk_value')->nullable();
            $table->string('makingdisper')->nullable();
            $table->string('makingdisc')->nullable();
            $table->string('scheme_discount')->nullable();
            $table->string('textbox_89')->nullable();
            $table->string('tax_item_group')->nullable();
            $table->string('tax_per')->nullable();
            $table->string('tax_amount')->nullable();
            $table->string('total_amount')->nullable();
            $table->string('line_amount')->nullable();
            $table->string('invoice_amount')->nullable();
            $table->string('buyer_tin')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_reports');
    }
}
