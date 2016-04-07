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
Route::group(['namespace' => 'Frontend'], function(){
    // Controllers Within The "App\Http\Controllers\Frontend" Namespace
	Route::get('/', 'IndexController@index');
	Route::get('/article/{id}', 'IndexController@show');
	Route::get('/login', 'LoginController@getLogin');
	Route::get('/logout', 'LoginController@getLogout');
	Route::post('/loginpost', 'LoginController@postLogin');

	Route::group(['middleware' => 'sslogin'], function(){

		Route::get('/user', 'UserController@index');
		Route::get('/post', 'PostController@create');

		Route::get('/post/{id}', 'PostController@edit');
		Route::post('/post/update', 'PostController@update');
		Route::post('/post', 'PostController@store');

	});
});

Route::group(['namespace' => 'Backend'], function(){

});

Route::group(['namespace' => 'Api'], function(){
	
});
