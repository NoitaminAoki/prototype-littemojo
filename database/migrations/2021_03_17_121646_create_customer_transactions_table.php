<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('course_id')->unsigned()->nullable();
            $table->string('transaction_code', 200);
            $table->integer('price');
            $table->integer('admin_fee');
            $table->integer('total_price');
            $table->bigInteger('promo_id')->unsigned()->nullable();
            $table->string('snap_token')->nullable();
            $table->enum('status_payment', ['waiting', 'pending', 'settlement', 'deny', 'expire', 'cancel']);
            $table->dateTime('start_date')->nullable();
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
        Schema::dropIfExists('customer_transactions');
    }
}
