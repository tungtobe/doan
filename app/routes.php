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

Route::get('/', 'HomeController@showWelcome');
Route::get('/login', 'AuthenController@getLogin');
Route::get('/signup', 'AuthenController@getSignup');
Route::get('/logout', 'AuthenController@getLogout');

Route::post('/authen/login', 'AuthenController@login');
Route::post('/authen/signup', 'AuthenController@signup');


Route::group(array('before' => 'app.auth'), function() {
    // Route::post('/comment/postStore', 'CommentController@postStore');
    // Route::post('/video/request/', 'VideoController@requestReborn');
    // Route::get('/video/reborn/{id}', 'VideoController@reborn');
    // Route::get('/video/deactive/{id}', 'VideoController@deactive');
    // Route::get('/video/delete/{id}', 'VideoController@delete');
    Route::get('/user/{id}', 'UserController@getShow');
    // Route::post('/video/upload', 'VideoController@upload');
});

Route::filter('app.auth', function() {
    if (Auth::guest()) {
        return Redirect::guest(URL::action('AuthenController@getLogin'));
    }
});
