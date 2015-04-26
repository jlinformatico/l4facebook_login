<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Integrating Facebook SDK 4 into Laravel application
| https://www.youtube.com/watch?v=2pJQbGXyi4E
| 
|[+] How to get and install Facebook PHP SDK 4 into Laravel project
|[+] How to create and configure a Facebook application that will be used for social sign-in
|[+] How to connect Facebook with Laravel and pass data from a Facebook profile to laravel application and consequently how to store it in the database 
|
*/

Route::get('/', function()
{
	$data = array();
	if(Auth::check()) {
		$data = Auth::user();
	}
	return View::make('hello')->with('data',$data);
});

Route::get('login/fb', 'LoginFacebookController@login');
Route::get('login/fb/callback', 'LoginFacebookController@callback');
Route::get('logout', function() {
	Auth::logout();
	return Redirect::to('/');
});
