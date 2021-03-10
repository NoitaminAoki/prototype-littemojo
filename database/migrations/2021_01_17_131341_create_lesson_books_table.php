<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_books', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lesson_id')->unsigned()->nullable();
            $table->uuid('uuid');
            $table->string('title');
            $table->integer('orders');
            $table->string('filename');
            $table->string('size', 20);
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
        Schema::dropIfExists('lesson_books');
    }
}
