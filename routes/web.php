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

    //Users CRUD
    Route::get('/user', 'users\UserController@index')->name('users.index');
    Route::get('users/show/id={id}', 'users\UserController@show')->name('users.show');
    Route::get('users/create', 'users\UserController@create')->name('users.create');
    Route::post('users/create', 'users\UserController@store')->name('users.store');
    Route::get('/users/id={id}/edit', 'users\UserController@edit')->name('users.edit');
    Route::post('/users/id={id}/update', 'users\UserController@update')->name('users.update');
    Route::get('/users/id={id}/delete', 'users\UserController@destroy')->name('users.destroy');

    //Categories CRUD
    Route::get('/categories', 'categories\CategoryController@index')->name('categories.index');
    Route::get('categories/show/id={id}', 'categories\CategoryController@show')->name('categories.show');
    Route::get('categories/create', 'categories\CategoryController@create')->name('categories.create');
    Route::post('categories/create', 'categories\CategoryController@store')->name('categories.store');
    Route::get('/categories/id={id}/edit', 'categories\CategoryController@edit')->name('categories.edit');
    Route::post('/categories/id={id}/update', 'categories\CategoryController@update')->name('categories.update');
    Route::get('/categories/id={id}/delete', 'categories\CategoryController@destroy')->name('categories.destroy');

    //Priority CRUD
    Route::get('/priorities', 'priorities\PriorityController@index')->name('priorities.index');
    Route::get('priorities/show/id={id}', 'priorities\PriorityController@show')->name('priorities.show');
    Route::get('priorities/create', 'priorities\PriorityController@create')->name('priorities.create');
    Route::post('priorities/create', 'priorities\PriorityController@store')->name('priorities.store');
    Route::get('/priorities/id={id}/edit', 'priorities\PriorityController@edit')->name('priorities.edit');
    Route::post('/priorities/id={id}/update', 'priorities\PriorityController@update')->name('priorities.update');
    Route::get('/priorities/id={id}/delete', 'priorities\PriorityController@destroy')->name('priorities.destroy');

    //Task CRUD
    Route::get('/tasks', 'tasks\TaskController@index')->name('tasks.index');
    Route::get('tasks/show/{id}', 'tasks\TaskController@show')->name('tasks.show');
    Route::get('tasks/create', 'tasks\TaskController@create')->name('tasks.create');
    Route::post('tasks/create', 'tasks\TaskController@store')->name('tasks.store');
    Route::get('/tasks/{id}/edit', 'tasks\TaskController@edit')->name('tasks.edit');
    Route::post('/tasks/{id}/update', 'tasks\TaskController@update')->name('tasks.update');
    Route::get('/tasks/{id}/delete', 'tasks\TaskController@destroy')->name('tasks.destroy');

});