<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnerWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partner_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('partner_id')->unsigned()->nullable();
            $table->bigInteger('bank_id')->unsigned()->nullable();
            $table->uuid('uuid');
            $table->string('image')->nullable();
            $table->string('path')->nullable();
            $table->integer('amount');
            $table->enum('status', ['pending', 'process', 'success']);
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
        Schema::dropIfExists('partner_withdrawals');
    }
}
