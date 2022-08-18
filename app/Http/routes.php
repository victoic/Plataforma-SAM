<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

/*
|--------------------------------------------------------------------------
| API routes
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::group(['prefix' => 'v1'], function () {
        require config('infyom.laravel_generator.path.api_routes');
    });
});


Route::resource('modules', 'ModuleController');

Route::resource('activities', 'ActivityController', 
	['except' => ['show']]);

Route::resource('exercises', 'ExerciseController');

Route::resource('alternatives', 'AlternativeController');

Route::resource('achievements', 'AchievementController',
	['only' => ['index, create, store']]);

Route::resource('titles', 'TitleController');

Route::resource('adventures', 'AdventureController');

Route::resource('users', 'UserController');

Route::get('/achievements', 'UserController@showAchievements');
Route::get('/settings', 'UserController@showSettings');
Route::get('/library', 'UserController@showLibrary');
Route::get('/classroom', 'UserController@showClassroom');
Route::get('exercises/{id}/image', 'UserController@getImage');
Route::get('activities/{idActivity}/{idModule}', ['as'=>'activities.show', 'uses'=>'ActivityController@show']);
Route::get('contact', function(){
	return view('contact');
});
Route::post('activities/storeAjax', ['as'=>'activities.storeAjax','uses'=>'ActivityController@storeAjax']);
Route::post('modules/storeAjax', ['as'=>'modules.storeAjax','uses'=>'ModuleController@storeAjax']);
Route::post('adventures/storeAjax', ['as'=>'adventures.storeAjax','uses'=>'AdventureController@storeAjax']);
Route::post('user/addStudent', ['as'=>'users.addStudent','uses'=>'UserController@addStudent']);
Route::post('user/changeActiveAchievement', 'UserController@changeActiveAchievement');
Route::post('user/unlockActivity', ['as'=>'users.unlockActivity','uses'=>'UserController@unlockActivity']);
Route::post('user/addAdventureToLibrary', ['as'=>'users.addAdventureToLibrary', 'uses'=>'UserController@addAdventureToLibrary']);
Route::post('user/removeAdventureFromLibrary', ['as'=>'users.removeAdventureFromLibrary', 'uses'=>'UserController@removeAdventureFromLibrary']);
Route::post('activities/addImage', ['as'=>'activities.addImage','uses'=>'ActivityController@addImage']);
Route::post('students/changeAdventure', ['as'=>'students.changeAdventure', 'uses'=>'StudentController@changeAdventure']);
Route::post('students/setMistakes', ['as'=>'students.setMistakes', 'uses'=>'StudentController@setMistakes']);

Route::resource('contacts', 'ContactController');

Route::resource('topics', 'TopicController');

Route::resource('students', 'StudentController');

Route::resource('teachers', 'TeacherController');