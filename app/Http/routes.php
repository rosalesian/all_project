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
    return view('users.login');
});

Route::resource('homes', 'HomesController');
Route::get('login', 'UsersController@getLogin');

Route::group(['prefix' => 'admin'], function(){
	Route::resource('users', 'UsersController');
	Route::post('requestLogin', 'UsersController@requestLogin');
	Route::resource('applicant', 'ApplicantsController');
});
