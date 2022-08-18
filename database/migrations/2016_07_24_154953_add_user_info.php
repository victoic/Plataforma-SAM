<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table){
            $table->integer('id_module_weakness')->unsigned()->nullable();
            $table->integer('id_activity_weakness')->unsigned()->nullable();

            $table->foreign('id_module_weakness')->references('id')->on('modules');
            $table->foreign('id_activity_weakness')->references('id')->on('activities');
        });

        Schema::create('user_module', function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->integer('id_module')->unsigned();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_module')->references('id')->on('modules');
        });

        Schema::create('user_activity', function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_user')->unsigned();
            $table->integer('id_activity')->unsigned();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_activity')->references('id')->on('activities');
        });

        Schema::table('user_adventure', function(Blueprint $table){
            $table->boolean('completed')->default(0);
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
