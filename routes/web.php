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
        Route::get('/user', 'User\UserController@index')->name('users.index');
        Route::get('users/show/id={id}', 'User\UserController@show')->name('users.show');
        Route::get('users/create', 'User\UserController@create')->name('users.create');
        Route::post('users/create', 'User\UserController@store')->name('users.store');
        Route::get('/users/id={id}/edit', 'User\UserController@edit')->name('users.edit');
        Route::post('/users/id={id}/update', 'User\UserController@update')->name('users.update');
        Route::get('/users/id={id}/delete', 'User\UserController@destroy')->name('users.destroy');
        Route::get('/users/id={id}/change/password', 'User\UserController@password')->name('users.password');
        Route::post('/users/id={id}/change/password', 'User\UserController@savepassword')->name('users.savepassword');

        //Categories CRUD
        Route::get('/categories', 'Category\CategoryController@index')->name('categories.index');
        Route::get('categories/show/id={id}', 'Category\CategoryController@show')->name('categories.show');
        Route::get('categories/create', 'Category\CategoryController@create')->name('categories.create');
        Route::post('categories/create', 'Category\CategoryController@store')->name('categories.store');
        Route::get('/categories/id={id}/edit', 'Category\CategoryController@edit')->name('categories.edit');
        Route::post('/categories/id={id}/update', 'Category\CategoryController@update')->name('categories.update');
        Route::get('/categories/id={id}/delete', 'Category\CategoryController@destroy')->name('categories.destroy');

        //Priority CRUD
        Route::get('/priorities', 'Priority\PriorityController@index')->name('priorities.index');
        Route::get('priorities/show/id={id}', 'Priority\PriorityController@show')->name('priorities.show');
        Route::get('priorities/create', 'Priority\PriorityController@create')->name('priorities.create');
        Route::post('priorities/create', 'Priority\PriorityController@store')->name('priorities.store');
        Route::get('/priorities/id={id}/edit', 'Priority\PriorityController@edit')->name('priorities.edit');
        Route::post('/priorities/id={id}/update', 'Priority\PriorityController@update')->name('priorities.update');
        Route::get('/priorities/id={id}/delete', 'Priority\PriorityController@destroy')->name('priorities.destroy');

        //Task CRUD
        Route::get('/tasks', 'Task\TaskController@index')->name('tasks.index');
        Route::get('tasks/show/{id}', 'Task\TaskController@show')->name('tasks.show');
        Route::get('tasks/create', 'Task\TaskController@create')->name('tasks.create');
        Route::post('tasks/create', 'Task\TaskController@store')->name('tasks.store');
        Route::get('/tasks/{id}/edit', 'Task\TaskController@edit')->name('tasks.edit');
        Route::post('/tasks/{id}/update', 'Task\TaskController@update')->name('tasks.update');
        Route::get('/tasks/{id}/delete', 'Task\TaskController@destroy')->name('tasks.destroy');

});