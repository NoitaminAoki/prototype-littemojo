<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quiz_id')->unsigned()->nullable();
            $table->uuid('uuid');
            $table->string('image')->nullable();
            $table->string('path')->nullable();
            $table->string('title')->nullable();
            $table->integer('orders');
            $table->timestamps();

            $table->foreign('quiz_id')->references('id')->on('lesson_quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_questions');
    }
}
