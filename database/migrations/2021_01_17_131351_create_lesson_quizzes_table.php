<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_quizzes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lesson_id')->unsigned()->nullable();
            $table->integer('orders');
            $table->string('title');
            $table->integer('total_question');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('lesson_id')->references('id')->on('course_lessons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_quizzes');
    }
}
