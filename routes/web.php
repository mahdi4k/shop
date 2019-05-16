<?php

use App\Http\Controllers\SiteController;

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

Route::get('/', 'SiteController@index');
Route::middleware(['throttle:150,1'])->group(function () {

    Route::middleware(['check_admin'])->group(function () {
        Route::get('/admin', 'Admin\PanelCotroller@index');
//admin_category
        Route::resource('admin/category', 'Admin\CategoryController', ['except' => ['show']]);
        Route::post('admin/category/del_img/{id}', 'Admin\CategoryController@del_img');

//admin_product
        Route::resource('admin/product', 'Admin\ProductController', ['except' => ['show']]);
        Route::get('admin/product/gallery', 'Admin\ProductController@gallery');
        Route::post('admin/product/upload', 'Admin\ProductController@upload');
        Route::post('admin/product/del_product_img/{id}', 'Admin\ProductController@del_product_img');

//filter_product
        Route::get('admin/filter', 'Admin\FilterController@index');
        Route::post('admin/filter', 'Admin\FilterController@create');

//item-section
        Route::get('admin/item', 'Admin\ItemController@index');
        Route::post('admin/item', 'Admin\ItemController@create');
        Route::get('admin/product/add-item/{id}', 'admin\ProductController@add_item_form');
        Route::post('admin/product/add_item', 'admin\ProductController@add_item_product');
//amazing product
        Route::resource('admin/amazing', 'Admin\AmazingController', ['except' => ['show']]);

//service product
        Route::resource('admin/service', 'Admin\ServiceController');
        Route::post('admin/service/get_price', 'Admin\ServiceController@get_price');
        Route::post('admin/service/set_price', 'Admin\ServiceController@set_price');
        Route::resource('admin/ostan', 'Admin\OstanController', ['except' => ['show']]);
        Route::resource('admin/shahr', 'Admin\ShahrController', ['except' => ['show']]);
//admin-review
        Route::get('admin/product/add-review', 'Admin\ProductController@add_review_form');

        Route::post('admin/product/add_review', 'Admin\ProductController@add_review');
        Route::post('admin/product/del_review_img/{id}', 'Admin\ProductController@del_review_img');


    });

    Route::get('admin_login', 'Admin\AdminController@admin_login');

//site controller
    Route::get('product/{code}/{title}', 'SiteController@show');
    Route::post('site/ajax_set_service', 'SiteController@set_service');
    Route::get('Cart', 'SiteController@show_cart');
    Route::post('Cart', 'SiteController@cart');
    Route::post('site/ajax_del_cart', 'SiteController@del_cart');
    Route::post('site/ajax_change_cart', 'SiteController@change_cart');
    Route::post('shop/add_address', 'ShopController@add_address');
    Route::post('shop/edit_address_form', 'ShopController@edit_address_form');
    Route::post('shop/edit_address/{address_id}', 'ShopController@edit_address');
    Route::delete('remove_address/{id}', 'ShopController@remove_address');
    Route::match(['get', 'post'], 'review', 'ShopController@review');
    Route::get('Payment', 'ShopController@Payment');
    Route::post('Payment', 'ShopController@Pay');
    Route::get('user/order', 'UserController@show_order');
    Route::get('logout', 'Auth\LoginController@logout');

    Auth::routes();

    Route::get('/home', 'SiteController@index')->name('home');
    Route::get('Captcha', function () {
        $Captcha = new \App\lib\Captcha();
        $Captcha->create();
    });
    Route::post('site/ajax_check_login', 'SiteController@check_login');
    Route::get('Shipping', 'ShopController@Shipping');
    Route::post('shop/get_ajax_shahr', 'ShopController@get_ajax_shahr');


//user route
    Route::get('user/order/print', 'UserController@print_order');
    Route::get('user/order/create_barcode', 'UserController@create_barcode');
    Route::get('user/order/pdf', 'UserController@create_pdf');
    Route::post('order', 'ShopController@update_order');
    Route::get('order', 'ShopController@update_order2');

});
