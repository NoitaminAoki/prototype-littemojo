<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_transaction_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('customer_transaction_id')->unsigned()->nullable();
            $table->string('midtrans_transaction_id', 200);
            $table->string('order_id', 200);
            $table->integer('total_amount');
            $table->string('payment_type', 50);
            $table->string('payment_type_readable', 50)->nullable();
            $table->string('bank', 20)->nullable();
            $table->string('va_number', 100)->nullable();
            $table->string('bill_key', 100)->nullable();
            $table->string('biller_code', 20)->nullable();
            $table->string('payment_code', 100)->nullable();
            $table->string('link_pdf_payment_method')->nullable();
            $table->dateTime('transaction_time')->nullable();
            $table->string('transaction_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_transaction_details');
    }
}
