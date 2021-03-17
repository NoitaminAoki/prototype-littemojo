<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerFundTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_fund_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('partner_id')->unsigned()->nullable();
            $table->bigInteger('customer_transaction_id')->unsigned()->nullable();
            $table->bigInteger('partner_withdrawal_id')->unsigned()->nullable();
            $table->enum('type_transaction', ['income', 'outcome']);
            $table->bigInteger('amount');
            $table->bigInteger('final_amount');
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
        Schema::dropIfExists('partner_fund_transactions');
    }
}
