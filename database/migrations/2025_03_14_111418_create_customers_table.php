<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->string('customer_id')->nullable();
            $table->time('customer_enter_time')->nullable();
            $table->time('customer_out_time')->nullable();
            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->date('dob')->nullable();
            $table->integer('martial_status')->default(0);
            $table->date('anniversary_date')->nullable();
            $table->unsignedBigInteger('profession_id')->nullable();
            $table->foreign('profession_id')->references('id')->on('professions');
            $table->unsignedBigInteger('qualfication_id')->nullable();
            $table->foreign('qualfication_id')->references('id')->on('qualifications');
            $table->string('address')->nullable();
            $table->string('pincode')->nullable();
            $table->integer('know_about')->default(0);
            $table->integer('is_purchased')->default(0);
            $table->integer('store_experience_review')->default(0);
            $table->integer('jewellery_review')->default(0);
            $table->integer('pricing_review')->default(0);
            $table->integer('satification_review')->default(0);
            $table->integer('friendly_review')->default(0);
            $table->integer('knowledge_review')->default(0);
            $table->integer('assit_review')->default(0);
            $table->integer('non-purchased_review')->default(0);
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
        Schema::dropIfExists('customers');
    }
}
