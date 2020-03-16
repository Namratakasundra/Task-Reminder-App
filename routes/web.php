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

Auth::routes();
Route::redirect('/','/login');
Route::group(["middleware"=>'auth'],function(){

    Route::get('/home', 'HomeController@index')->name('home');

    //User CRUD
    Route::get('/user', 'UserController@index')->name('users.index');
    Route::get('users/show/id={id}', 'UserController@show')->name('users.show');
    Route::get('users/create','UserController@create')->name('users.create');
    Route::post('users/create','UserController@store')->name('users.store');
    Route::get('/users/id={id}/edit','UserController@edit')->name('users.edit');
    Route::post('/users/id={id}/update','UserController@update')->name('users.update');
    Route::get('/users/id={id}/delete','UserController@destroy')->name('users.destroy');

    //Categories CRUD
    Route::get('/categories', 'CategoryController@index')->name('categories.index');
    Route::get('categories/show/id={id}', 'CategoryController@show')->name('categories.show');
    Route::get('categories/create','CategoryController@create')->name('categories.create');
    Route::post('categories/create','CategoryController@store')->name('categories.store');
    Route::get('/categories/id={id}/edit','CategoryController@edit')->name('categories.edit');
    Route::post('/categories/id={id}/update','CategoryController@update')->name('categories.update');
    Route::get('/categories/id={id}/delete','CategoryController@destroy')->name('categories.destroy');

    //Priority CRUD
    Route::get('/priorities', 'PriorityController@index')->name('priorities.index');
    Route::get('priorities/show/id={id}', 'PriorityController@show')->name('priorities.show');
    Route::get('priorities/create','PriorityController@create')->name('priorities.create');
    Route::post('priorities/create','PriorityController@store')->name('priorities.store');
    Route::get('/priorities/id={id}/edit','PriorityController@edit')->name('priorities.edit');
    Route::post('/priorities/id={id}/update','PriorityController@update')->name('priorities.update');
    Route::get('/priorities/id={id}/delete','PriorityController@destroy')->name('priorities.destroy');

    //Task CRUD
    Route::get('/tasks', 'TaskController@index')->name('tasks.index');
    Route::get('tasks/show/{id}', 'TaskController@show')->name('tasks.show');
    Route::get('tasks/create','TaskController@create')->name('tasks.create');
    Route::post('tasks/create','TaskController@store')->name('tasks.store');
    Route::get('/tasks/{id}/edit','TaskController@edit')->name('tasks.edit');
    Route::post('/tasks/{id}/update','TaskController@update')->name('tasks.update');
    Route::get('/tasks/{id}/delete','TaskController@destroy')->name('tasks.destroy');

});