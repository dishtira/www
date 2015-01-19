<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@showHome'
));

Route::get('register',array(
	'as' => 'register-show',
	'uses' => 'UserController@showRegister'
));

Route::group(array('before' => 'auth'), function()
{

	Route::get('logout', array(
		'as' => 'logout',
		'uses' => 'UserController@doLogout'
	));
});

Route::group(array('before' => 'guest'), function(){

	Route::group(array('before' => 'csrf'), function()
	{

		Route::post('login', array(
			'as' => 'doLogin',
			'uses' => 'UserController@doLogin'
		));

		Route::post('register', array(
			'as' => 'register-post',
			'uses' => 'UserController@register'
		));

	});

});