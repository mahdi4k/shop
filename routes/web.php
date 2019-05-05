<?php

use App\Http\Controllers\homeController;

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

Route::get('/', 'homeController@index');
Route::get('/admin', 'Admin\PanelCotroller@index');

//admin_category
Route::resource('admin/category', 'Admin\CategoryController', ['except' => ['show']]);
Route::post('admin/category/del_img/{id}', 'Admin\CategoryController@del_img');

//admin_product
Route::resource('admin/product', 'Admin\ProductController', ['except' => ['show']]);
Route::get('admin/product/gallery', 'Admin\ProductController@gallery');
Route::post('admin/product/upload', 'Admin\ProductController@upload');
Route::post('admin/product/del_product_img/{id}','Admin\ProductController@del_product_img');

//filter_product
Route::get('admin/filter','Admin\FilterController@index');
Route::post('admin/filter','Admin\FilterController@create');

//item-section
Route::get('admin/item','Admin\ItemController@index');
Route::post('admin/item','Admin\ItemController@create');

//amazing product
Route::resource('admin/amazing','Admin\AmazingController',['except'=>['show']]);

//service product
Route::resource('admin/service','Admin\ServiceController');
Route::post('admin/service/get_price','Admin\ServiceController@get_price');
Route::post('admin/service/set_price','Admin\ServiceController@set_price');

//site controller
Route::get('product/{code}/{title}','homeController@show');
