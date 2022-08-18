<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherAndStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create table for Student
        Schema::create('students', function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_user')->unsigned()
            $table->foreign('id_user')->references('id')->on('users');

            $table->integer('id_current_adventure')->unsigned();
            $table->foreign('id_current_adventure')->references('id')->on('adventures');
            $table->integer('id_current_module')->unsigned();
            $table->foreign('id_current_module')->references('id')->on('modules');
            $table->integer('id_current_activity')->unsigned();
            $table->foreign('id_current_activity')->references('id')->on('activities');

            $table->boolean('adventure_ended')->default(0);

            $table->integer('id_weakest_module')->unsigned();
            $table->foreign('id_weakest_module')->references('id')->on('modules');
            $table->integer('id_weakest_activity')->unsigned();
            $table->foreign('id_weakest_activity')->references('id')->on('activities');

            $table->integer('id_teacher')->unsigned();
            $table->timestamps();
        });

        //Create table for Teacher
        Schema::create('teachers', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        //Add foreign key to Student's Teacher
        Schema::table('students', function(Blueprint $table){
            $table->foreign('id_teacher')->references('id')->on('teachers');
        });

        //Modify creations tables, relating it's id_creator to the Teacher table
        Schema::table('adventures', function(Blueprint $table){
            $table->dropColumn('id_creator');
            $table->boolean('type')->default(0);
            $table->foreign('id_creator')->references('id')->on('teachers');
        });

        Schema::table('modules', function(Blueprint $table){
            $table->dropColumn('id_creator');
            $table->boolean('type')->default(0);
            $table->foreign('id_creator')->references('id')->on('teachers');
        });

        Schema::table('activities', function(Blueprint $table){
            $table->dropColumn('id_creator');
            $table->boolean('type')->default(0);
            $table->foreign('id_creator')->references('id')->on('teachers');
        });

        //Create new table for the creations added to a Teacher library
        Schema::drop('user_activitiy');
        Schema::create('teacher_activities_library', function(Blueprint $table){
            $table->increments('id');

            $table->integer('id_activity')->unsigned();
            $table->foreign('id_activity')->references('id')->on('activities');
            $table->integer('id_teacher')->unsigned();
            $table->foreign('id_teacher')->references('id')->on('teachers');

            $table->timestamps();            
        });
        Schema::drop('user_adventure');
        Schema::create('teacher_adventures_library', function(Blueprint $table){
            $table->increments('id');

            $table->integer('id_adventure')->unsigned();
            $table->foreign('id_adventure')->references('id')->on('adventures');
            $table->integer('id_teacher')->unsigned();
            $table->foreign('id_teacher')->references('id')->on('teachers');

            $table->timestamps();            
        });
        Schema::drop('user_module');
        Schema::create('teacher_modules_library', function(Blueprint $table){
            $table->increments('id');

            $table->integer('id_module')->unsigned();
            $table->foreign('id_module')->references('id')->on('modules');
            $table->integer('id_teacher')->unsigned();
            $table->foreign('id_teacher')->references('id')->on('teachers');

            $table->timestamps();            
        });

        //Modify User table with necessary modifications
        Schema::table('', function(Blueprint $table){
            $table->dropColumn('id_adventure');
            $table->dropColumn('id_unlocked_activity');
            $table->dropColumn('id_unlocked_module');
            $table->dropColumn('id_teacher');
            $table->dropColumn('id_activity_weakness');
            $table->dropColumn('id_module_weakness');
            $table->dropColumn('adventure_ended');

            $table->integer('id_student')->unsigned();
            $table->foreign('id_student')->references('id')->on('students');
            $table->integer('id_teacher')->unsigned();
            $table->foreign('id_teacher')->references('id')->on('teachers');

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
