<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdventureModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adventure_module', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order');
            $table->timestamps();

            $table->integer('id_adventure')->unsigned();
            $table->foreign('id_adventure')->references('id')->on('adventures');
            $table->integer('id_module')->unsigned();
            $table->foreign('id_module')->references('id')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('adventure_module');
    }
}
