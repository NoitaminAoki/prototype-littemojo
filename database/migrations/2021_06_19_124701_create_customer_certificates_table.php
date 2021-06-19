<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_certificates', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('course_id')->unsigned()->nullable();
            $table->uuid('uuid');
            $table->string('hash_id', 20);
            $table->string('filename');
            $table->text('path');
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
        Schema::dropIfExists('customer_certificates');
    }
}
