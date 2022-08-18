<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('birth_date');
            $table->time('active_time')->nullable();
            $table->string('email')->unique();
            $table->boolean('teacher');
            $table->string('password');
            $table->integer('points');
            $table->rememberToken();
            $table->timestamps();

            $table->integer('id_adventure')->unsigned()->nullable();
            $table->foreign('id_adventure')->references('id')->on('adventures');
            $table->integer('id_unlocked_activity')->unsigned()->nullable();
            $table->foreign('id_unlocked_activity')->references('id')->on('activities');
        });

        Schema::table('modules', function(Blueprint $table){
            $table->foreign('id_creator')->references('id')->on('users');
        });

        Schema::table('activities', function(Blueprint $table){
            $table->foreign('id_creator')->references('id')->on('users');
        });

        Schema::table('adventures', function(Blueprint $table){
            $table->foreign('id_creator')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
