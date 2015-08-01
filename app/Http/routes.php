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

Route::post('/ex', function (){
    return response()->json(['ex' => true]);
});

Route::group(['prefix' => 'api/v1'], function() {
    
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
    
    Route::put('user/edit', [
        'uses' => 'UsersController@edit'
    ]);
    
    Route::post('user/forgot_password', [
        'uses' => 'UsersController@forgotPassword'
    ]);
    
});