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
    Route::get('/users', 'User\UserController@index');
    Route::get('users/show/id={id}', 'User\UserController@show');
    Route::get('users/create', 'User\UserController@create');
    Route::post('users/create', 'User\UserController@store');
    Route::get('/users/id={id}/edit', 'User\UserController@edit');
    Route::post('/users/id={id}/update', 'User\UserController@update');
    Route::get('/users/id={id}/delete', 'User\UserController@destroy');

    //Categories CRUD
    Route::get('/categories', 'Category\CategoryController@index');
    Route::get('categories/show/id={id}', 'Category\CategoryController@show');
    Route::get('categories/create', 'Category\CategoryController@create');
    Route::post('categories/create', 'Category\CategoryController@store');
    Route::get('/categories/id={id}/edit', 'Category\CategoryController@edit');
    Route::post('/categories/id={id}/update', 'Category\CategoryController@update');
    Route::get('/categories/id={id}/delete', 'Category\CategoryController@destroy');

    //Priority CRUD
    Route::get('/priorities', 'Priority\PriorityController@index');
    Route::get('priorities/show/id={id}', 'Priority\PriorityController@show');
    Route::get('priorities/create', 'Priority\PriorityController@create');
    Route::post('priorities/create', 'Priority\PriorityController@store');
    Route::get('/priorities/id={id}/edit', 'Priority\PriorityController@edit');
    Route::post('/priorities/id={id}/update', 'Priority\PriorityController@update');
    Route::get('/priorities/id={id}/delete', 'Priority\PriorityController@destroy');

    //Task CRUD
    Route::get('/tasks', 'Task\TaskController@index');
    Route::get('tasks/show/{id}', 'Task\TaskController@show');
    Route::get('tasks/create', 'Task\TaskController@create');
    Route::post('tasks/create', 'Task\TaskController@store');
    Route::get('/tasks/{id}/edit', 'Task\TaskController@edit');
    Route::post('/tasks/{id}/update', 'Task\TaskController@update');
    Route::get('/tasks/{id}/delete', 'Task\TaskController@destroy');

});