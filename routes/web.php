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

//authenticating
Auth::routes();

//Admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function()
{
    Route::get('/', function () {
        $category = \App\Category::find(4);
        $products = $category->products;
        dd($products->toArray());

        return view('admin.index');
    });
    //category
	Route::get('/category/create/{category}', 'CategoryController@create');
    Route::resource('category', 'CategoryController');
    //товары
	Route::get('/product/create/{category}', 'ProductController@create');
    Route::resource('product', 'ProductController');

});