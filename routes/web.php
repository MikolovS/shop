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
//authenticating
Auth::routes();
Route::get('/', 'PublicController@index');
Route::get('/admin', 'CategoryController@index');
Route::get('/{category}', 'PublicController@show');


//Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
{
    Route::get('/', function () {
        return view('admin.index');
    });
    //category
	Route::get('/category/create/{category}', 'CategoryController@create');
    Route::resource('category', 'CategoryController');
    //товары
	Route::get('/product/create/{category}', 'ProductController@create');
    Route::resource('product', 'ProductController');

});