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
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('catalog_id')->unsigned()->nullable();
            $table->bigInteger('catalog_topic_id')->unsigned()->nullable();
            $table->bigInteger('level_id')->unsigned()->nullable();
            $table->string('title', 150);
            $table->string('slug_title', 150);
            $table->text('description');
            $table->bigInteger('price');
            $table->enum('duration', ['week', 'month']);
            $table->uuid('uuid');
            $table->string('cover');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_published')->default(false);
            $table->datetime('date_verified')->nullable();
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
