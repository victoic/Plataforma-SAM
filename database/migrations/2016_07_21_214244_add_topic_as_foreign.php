<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTopicAsForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activities', function(Blueprint $table){
            $table->integer('id_topic')->unsigned()->nullable();
            $table->foreign('id_topic')->references('id')->on('topics');
        });
        Schema::table('exercises', function(Blueprint $table){
            $table->integer('id_topic')->unsigned()->nullable();
            $table->foreign('id_topic')->references('id')->on('topics');
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
