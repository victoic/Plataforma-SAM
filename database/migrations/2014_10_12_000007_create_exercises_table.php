<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stem');
            $table->string('topic');
            $table->integer('type');
            $table->timestamps();

            $table->integer('id_activity')->unsigned();
            $table->foreign('id_activity')->references('id')->on('activities');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('exercises');
    }
}
