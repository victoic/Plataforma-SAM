<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlternativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternatives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->boolean('right');
            $table->timestamps();

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
        Schema::drop('alternatives');
    }
}
