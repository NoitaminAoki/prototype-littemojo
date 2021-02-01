<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('catalog_id')->unsigned()->nullable();
            $table->integer('catalog_topic_id')->unsigned()->nullable();
            $table->integer('level_id')->unsigned()->nullable();
            $table->string('title', 100);
            $table->text('description');
            $table->bigInteger('price');
            $table->enum('duration', ['week', 'month']);
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
        Schema::dropIfExists('courses');
    }
}
