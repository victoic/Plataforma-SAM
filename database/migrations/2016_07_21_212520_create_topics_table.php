<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();

            $table->integer('id_activity')->unsigned();
            $table->foreign('id_activity')->references('id')->on('activities');
            $table->integer('id_exercise')->unsigned();
            $table->foreign('id_exercise')->references('id')->on('exercises');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
