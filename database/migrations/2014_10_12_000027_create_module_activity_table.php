<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_activity', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order');
            $table->timestamps();

            $table->integer('id_module')->unsigned();
            $table->foreign('id_module')->references('id')->on('modules');
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
        Schema::drop('module_activity');
    }
}
