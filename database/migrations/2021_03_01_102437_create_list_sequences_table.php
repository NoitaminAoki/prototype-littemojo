<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListSequencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_sequences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sequence_id')->unsigned()->nullable();
            $table->bigInteger('book_id')->unsigned()->nullable();
            $table->bigInteger('video_id')->unsigned()->nullable();
            $table->bigInteger('quiz_id')->unsigned()->nullable();
            $table->enum('type', ['book', 'video', 'quiz']);
            $table->integer('order');
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
        Schema::dropIfExists('list_sequences');
    }
}
