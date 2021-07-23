<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('signup','Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup','Auth\RegisterController@register')->name('signup.post');

Route::get('posts','PostsController@index')->name('index');
Route::get('post/create','PostsController@create')->name('create');
Route::get('post/edit/{id}','PostsController@edit')->name('edit');

Route::resource('users','UsersController',['only'=>'show']);

Route::group(['prefix' => 'users/{id}'], function(){
    Route::get('followings', 'UsersController@followings')->name('followings');
    Route::get('followers', 'UsersController@followers')->name('followings');
});

Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'users/{id}'], function(){
        Route::post('follow','UserFollowController@store')->name('follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('unfollow');
    });
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('posts','PostsController',['only' => ['create','store','destroy']]);
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('comments','CommentsController',['only' => ['create','store','destroy']]);
});