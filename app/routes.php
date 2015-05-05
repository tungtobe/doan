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

Route::get('/item/{id}', 'ItemController@getShow');
Route::get('/user/{id}', 'UserController@getShow');
Route::get('/search','HomeController@search');


Route::group(array('before' => 'app.auth'), function() {
  // Route for admin function
  Route::get('/admin','AdminController@getShow');
  Route::match(array('GET', 'POST'), '/admin/adduser', 'AdminController@addUser');
  Route::get('/admin/showuser', 'AdminController@showUser');
  Route::get('/admin/showdeactiveuser', 'AdminController@showDeactiveUser');
  Route::get('/admin/additem', 'AdminController@addItem');
  Route::get('/admin/showitem', 'AdminController@showItem');
  Route::get('/admin/showbill', 'AdminController@showBill');
  Route::get('/admin/showsysvar', 'AdminController@showSystemVar');

  Route::post('/admin/changeAdminPermission', 'AdminController@changeAdminPermission');
  Route::post('/admin/postBanUser', 'AdminController@postBanUser');
  Route::post('/admin/deleteItem', 'AdminController@postDeleteItem');

  Route::get('/admin/editItem/{id}', 'AdminController@postEditItem');

  //Route for user function
  Route::get('/user/favorite/{id}', 'UserController@getFavorite');
  Route::get('/user/bill/{id}', 'UserController@getBill');
  Route::get('/user/friends/{id}', 'UserController@getFriends');

  Route::get('/user/{id}', 'UserController@getShow');
  Route::post('/user/addfriend', 'UserController@addFriend');
  Route::post('/user/removefavorite','UserController@removeFromFavorite');
  Route::post('/user/makebill','UserController@makeBill');

  // Route for Items
  Route::post('/item/addfavorite', 'ItemController@addFavorite');
  Route::post('/item/comment','CommentController@postStore');
  Route::post('/item/vote','ItemController@vote');

  // Route for recommend
  Route::post('/recommend','RecommendController@reciveCritique');
    
});

Route::filter('app.auth', function() {
    if (Auth::guest()) {
        return Redirect::guest(URL::action('AuthenController@getLogin'));
    }
});
