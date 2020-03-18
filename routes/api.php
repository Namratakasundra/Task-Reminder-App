<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users','users\UserController@index');
Route::get('users/show/id={id}', 'users\UserController@show');
Route::get('users/create','users\UserController@create');
Route::post('users/create','users\UserController@store');
Route::get('/users/id={id}/edit','users\UserController@edit');
Route::post('/users/id={id}/update','users\UserController@update');
Route::get('/users/id={id}/delete','users\UserController@destroy');