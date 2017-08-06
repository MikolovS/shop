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

Route::get('/', 'CategoryController@welcome');

Route::get('/test2', 'CategoryController@test2');


//authenticating
Auth::routes();

//Admin
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function()
{
    Route::get('/', function () {
        return view('admin_layouts.admin');
    });
    //category
    Route::get('/category/create', 'CategoryController@create');
    Route::post('/category', 'CategoryController@store');
});