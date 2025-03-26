<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalkinCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('walkin_customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->unsignedBigInteger('sales_executive_id')->nullable();
            $table->foreign('sales_executive_id')->references('id')->on('employees');
            $table->string('daily_count')->nullable();
            $table->string('customer_enter_time')->nullable();
            $table->string('customer_out_time')->nullable();
            $table->integer('is_purchased')->default(0);
            $table->integer('store_experience_review')->default(0);
            $table->integer('jewellery_review')->default(0);
            $table->integer('pricing_review')->default(0);
            $table->integer('staff_review')->default(0);
            $table->integer('friendly_review')->default(0);
            $table->integer('service_review')->default(0);
            $table->integer('assit_review')->default(0);
            $table->integer('non_purchased_review')->default(0);
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
        Schema::dropIfExists('walkin_customers');
    }
}
