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

Route::group(['prefix' => 'api/v1'], function() {
//    Route::resource('user', 'UsersController');
    
//    Route::get('user', [
//        'uses' => 'UsersController@index'
//    ]);
    
//    Route::get('user/login', [
//        'as' => 'login',
//        'uses' => 'UsersController@login'
//    ]);
    
    Route::post('user/login', [
        'as' => 'login',
        'uses' => 'UsersController@login'
    ]);
    
    Route::post('user/signup', [
        'as' => 'signup',
        'uses' => 'UsersController@signup',
        'middleware' => 'userPic'
    ]);
    
    Route::get('user/logout', [
        'as' => 'logout',
        'uses' => 'UsersController@logout'
    ]);
    
    Route::put('user/edit/{id}', [
        'uses' => 'UsersController@edit'
    ]);
    
    Route::post('user/forgot_password', [
        'uses' => 'UsersController@forgotPassword'
    ]);
    
});
