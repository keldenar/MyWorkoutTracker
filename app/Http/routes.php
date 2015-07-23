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

Route::get('/', function() {
    return Redirect::to("user");
});

Route::get('home', function() {
    return Redirect::to("user");
});

Route::get('faq', function() {
   return view('faq');
});

Route::get('donate', function() {
   return view('donate');
});

Route::get('awesome', function() {
    return view('awesome');
});

Route::get('user/{name?}', 'UserController@index');

Route::controllers([
    'workout'=>'WorkoutController',
    'admin' => 'Admin\AdminController',
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
    'suggest' => 'SuggestionController',
    'test' => 'TestController',
]);

Route::group(array('prefix' => 'api/v1', 'middleware' => 'auth.basic',), function()
{
    Route::resource('user', 'apiUserController');
});