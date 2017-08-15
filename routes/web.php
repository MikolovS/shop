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
Route::get('/welcome', 'CategoryController@welcome');
Route::get('/admin', 'CategoryController@index');
Route::get('/{category}', 'PublicController@showCategory')
	->where('category', '^[\w]+(?:-[\w]+)*$'); // aaa-aaa(aaa)
Route::get('/{product}', 'PublicController@showProduct')
	->where('product', '^[\w]+(?:-[\w]+)*--[\w]+(?:-[\w]+)*$'); //aaa-aaa(aaa)--aaa
// ^[\w]+(?:-[\w]+)*$  - cat
//^[\w]+(?:-[\w]+)*--[\w]+(?:-[\w]+)*$ prod
Route::post('/user/addToCart', 'UserController@addToCart');

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