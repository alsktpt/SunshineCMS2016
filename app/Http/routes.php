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
Route::group(['namespace' => 'Api', 'prefix' => 'api'], function(){
	Route::resource('/collection', 'CollectionController');
	// Route::resource('/comment', 'CommentController');
	// Route::resource('/anthology', 'AnthologyController');
	// Route::resouce('/user', 'UserController');
	Route::resource('/favorate', 'FavorateController');

});


Route::group(['namespace' => 'Backend', 'prefix' => 'ssbackend'], function(){
	Route::group(['middleware' => 'ssadmin'], function() {
	    Route::get('/', 'IndexController@getIndexPage');

	    Route::get('/collection', 'IndexController@getCreateCollection');
	    Route::get('/collectionlist', 'IndexController@getCollectionListPage');
	    Route::get('/collection/{uri}', 'IndexController@showCollection');
	});
});


Route::group(['namespace' => 'Frontend'], function(){
    // Controllers Within The "App\Http\Controllers\Frontend" Namespace
	Route::get('/', 'IndexController@getLandingPage');
	
	Route::get('/article/{id}', 'IndexController@showArticle');
	Route::get('/profile/{id}', 'IndexController@showUserProfile');

	Route::get('/login', 'LoginController@getLogin');
	Route::get('/logout', 'LoginController@getLogout');
	Route::post('/login', 'LoginController@postLogin');


	Route::group(['middleware' => 'sslogin'], function(){

		Route::get('/user', 'UserController@index');

		Route::get('/post', 'PostController@create');
		Route::get('/post/{id}', 'PostController@edit');
		Route::post('/post/update', 'PostController@update');
		Route::post('/post', 'PostController@store');

	});

	Route::get('/{uri}', 'IndexController@getCollectionPage');
	Route::get('/{uri}/anthologies', 'IndexController@showCollectionAnthologies');
	Route::get('/{uri}/anthology/{id}', 'IndexController@showCollectionAntholgy');
	Route::get('/{uri}/post/{id}', 'IndexController@showCollectionArticle');

});





