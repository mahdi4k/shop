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
Route::resource('admin/category', 'admin\CategoryController', ['except' => ['show']]);
Route::post('admin/category/del_img/{id}', 'admin\CategoryController@del_img');

//admin_product
Route::resource('admin/product', 'admin\ProductController', ['except' => ['show']]);
Route::get('admin/product/gallery', 'admin\ProductController@gallery');
Route::post('admin/product/upload', 'admin\ProductController@upload');
Route::post('admin/product/del_product_img/{id}','admin\ProductController@del_product_img');

