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
            $table->string('STORE')->nullable();
            $table->string('NAME')->nullable();
            $table->integer('GENDER')->nullable();
            $table->string('CUSTOMER_ID')->nullable();
            $table->string('MOBILE_NUMBER')->nullable();
            $table->string('DATE_OF_BIRTH')->nullable();
            $table->string('E-MAIL_ID')->nullable();
            $table->string('AGE')->nullable();
            $table->string('MARITAL_STATUS')->nullable();
            $table->string('ANNIVERSARY_DATE')->nullable();
            $table->string('EDUCATIONAL_QUALIFICATION')->nullable();
            $table->string('PROFESSION')->nullable();
            $table->string('LAST_VISIT_DATE')->nullable();
            $table->string('SALES_HANDLED_PERSON')->nullable();
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
