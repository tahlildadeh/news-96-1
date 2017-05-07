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

Route::get('test', function(){
   echo route('admin_user_with_id', ['id' => 95]);
});

Route::group(['prefix' => 'backoffice', 'as'=>'admin_', 'namespace'=>'Admin'], function(){
    Route::get('dashboard', function(){

    });

    Route::get('/use/{id1?}/{id2?}/{id3?}/{id4?}/{id5?}', 'UserController@index');
    Route::get('user/{id?}', ['as' => 'user_with_id', 'uses' => 'UserController@user']);
});
Route::auth();

Route::get('/home', 'HomeController@index');
