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

Route::group(["middleware"=>'task'],function(){

    //Users CRUD
    Route::get('/users', 'users\UserController@index');
    Route::get('users/show/id={id}', 'users\UserController@show');
    Route::get('users/create', 'users\UserController@create');
    Route::post('users/create', 'users\UserController@store');
    Route::get('/users/id={id}/edit', 'users\UserController@edit');
    Route::post('/users/id={id}/update', 'users\UserController@update');
    Route::get('/users/id={id}/delete', 'users\UserController@destroy');

    //Categories CRUD
    Route::get('/categories', 'categories\CategoryController@index');
    Route::get('categories/show/id={id}', 'categories\CategoryController@show');
    Route::get('categories/create', 'categories\CategoryController@create');
    Route::post('categories/create', 'categories\CategoryController@store');
    Route::get('/categories/id={id}/edit', 'categories\CategoryController@edit');
    Route::post('/categories/id={id}/update', 'categories\CategoryController@update');
    Route::get('/categories/id={id}/delete', 'categories\CategoryController@destroy');

    //Priority CRUD
    Route::get('/priorities', 'priorities\PriorityController@index');
    Route::get('priorities/show/id={id}', 'priorities\PriorityController@show');
    Route::get('priorities/create', 'priorities\PriorityController@create');
    Route::post('priorities/create', 'priorities\PriorityController@store');
    Route::get('/priorities/id={id}/edit', 'priorities\PriorityController@edit');
    Route::post('/priorities/id={id}/update', 'priorities\PriorityController@update');
    Route::get('/priorities/id={id}/delete', 'priorities\PriorityController@destroy');

    //Task CRUD
    Route::get('/tasks', 'tasks\TaskController@index');
    Route::get('tasks/show/{id}', 'tasks\TaskController@show');
    Route::get('tasks/create', 'tasks\TaskController@create');
    Route::post('tasks/create', 'tasks\TaskController@store');
    Route::get('/tasks/{id}/edit', 'tasks\TaskController@edit');
    Route::post('/tasks/{id}/update', 'tasks\TaskController@update');
    Route::get('/tasks/{id}/delete', 'tasks\TaskController@destroy');

});