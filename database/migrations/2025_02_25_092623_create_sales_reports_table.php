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
            $table->string('INVENTLOCATIONID1')->nullable();
            $table->string('INVOICEDATE')->nullable();
            $table->string('INVENTLOCATIONID')->nullable();
            $table->string('DIMENSION2_')->nullable();  
            $table->string('ARTICLECODE')->nullable();
            $table->string('NAME')->nullable();
            $table->string('NAMEALIAS1')->nullable();
            $table->string('SKUNUMBER')->nullable();
            $table->string('SALESID')->nullable();
            $table->string('SalesPerson')->nullable();
            $table->string('REFCUSTORDERID')->nullable();
            $table->string('REFAPPROVALSALESIDDTH')->nullable();
            $table->string('GOPAS')->nullable();
            $table->string('INVOICEID')->nullable();
            $table->string('GRWEIGHT')->nullable();
            $table->string('PCS')->nullable();
            $table->string('NETCHARGERABLE')->nullable();
            $table->string('SALESQTY')->nullable();
            $table->string('CtWght')->nullable();
            $table->string('Textbox33')->nullable();
            $table->string('ORDERACCOUNT')->nullable();
            $table->string('DELIVERYNAME')->nullable();
            $table->string('CELLULARPHONE')->nullable();
            $table->string('SALESPRICE')->nullable();
            $table->string('CVALUE')->nullable();
            $table->string('STUDDVALUE')->nullable();
            $table->string('MKCODE')->nullable();
            $table->string('SALECALCTYPE')->nullable();
            $table->string('AMT1')->nullable();
            $table->string('MKRATE')->nullable();
            $table->string('MKVALUE')->nullable();
            $table->string('MAKINGDISCPER')->nullable();
            $table->string('MAKINGDISC')->nullable();
            $table->string('SCHEMEDISCOUNT')->nullable();
            $table->string('Textbox89')->nullable();
            $table->string('TAXITEMGROUP')->nullable();
            $table->string('TAXPER')->nullable();
            $table->string('TAXAMOUNT')->nullable();
            $table->string('TOTALAMOUNT')->nullable();
            $table->string('LINEAMOUNT')->nullable();
            $table->string('INVOICEAMOUNT')->nullable();
            $table->string('BuyerTIN')->nullable();
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
