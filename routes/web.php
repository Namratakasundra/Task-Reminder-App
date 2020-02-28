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
    return view('layouts/admin');
});

//For searching in User
Route::get('/search_user','UserController@search_user');
//User CRUD
Route::get('/user', 'UserController@index')->name('user.index');
Route::get('user/show/id={id}', 'UserController@show')->name('user.show');
Route::get('user/create','UserController@create')->name('user.create');
Route::post('user/create','UserController@store')->name('user.store');
Route::get('/user/id={id}/edit','UserController@edit')->name('user.edit');
Route::post('/user/id={id}/update','UserController@update')->name('user.update');
Route::get('/user/id={id}/delete','UserController@destroy')->name('user.destroy');

//Category CRUD
Route::get('/category', 'CategoryController@index')->name('category.index');
Route::get('category/show/id={id}', 'CategoryController@show')->name('category.show');
Route::get('category/create','CategoryController@create')->name('category.create');
Route::post('category/create','CategoryController@store')->name('category.store');
Route::get('/category/id={id}/edit','CategoryController@edit')->name('category.edit');
Route::post('/category/id={id}/update','CategoryController@update')->name('category.update');
Route::get('/category/id={id}/delete','CategoryController@destroy')->name('category.destroy');

//Priority CRUD
Route::get('/priority', 'PriorityController@index')->name('priority.index');
Route::get('priority/show/id={id}', 'PriorityController@show')->name('priority.show');
Route::get('priority/create','PriorityController@create')->name('priority.create');
Route::post('priority/create','PriorityController@store')->name('priority.store');
Route::get('/priority/id={id}/edit','PriorityController@edit')->name('priority.edit');
Route::post('/priority/id={id}/update','PriorityController@update')->name('priority.update');
Route::get('/priority/id={id}/delete','PriorityController@destroy')->name('priority.destroy');

//For searching in User
Route::get('/search_task','TaskController@search_task');
//Task CRUD
Route::get('/task', 'TaskController@index')->name('task.index');
Route::get('task/show/id={id}', 'TaskController@show')->name('task.show');
Route::get('task/create','TaskController@create')->name('task.create');
Route::post('task/create','TaskController@store')->name('task.store');
Route::get('/task/id={id}/edit','TaskController@edit')->name('task.edit');
Route::post('/task/id={id}/update','TaskController@update')->name('task.update');
Route::get('/task/id={id}/delete','TaskController@destroy')->name('task.destroy');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
