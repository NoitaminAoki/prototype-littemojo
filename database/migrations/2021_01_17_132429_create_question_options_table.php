<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('question_id')->unsigned()->nullable();
            $table->uuid('uuid');
            $table->integer('orders');
            $table->string('image')->nullable();
            $table->string('path')->nullable();
            $table->string('title')->nullable();
            $table->enum('type', ['image', 'text']);
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
        Schema::dropIfExists('question_options');
    }
}
