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


Route::middleware(['throttle:150,1'])->group(function () {

        Route::middleware(['check_admin', 'load_admin_data'])->group(function () {
                Route::get('/admin', 'Admin\PanelCotroller@index');
                //admin_category
                Route::resource('admin/category', 'Admin\CategoryController', ['except' => ['show']]);
                Route::post('admin/category/del_img/{id}', 'Admin\CategoryController@del_img');

                //admin_discount
                Route::resource('admin/order/discount', 'Admin\DiscountController', ['except' => ['show']]);
                //slider
                Route::resource('admin/slider', 'Admin\SliderController', ['except' => ['show']]);
                //admin_product
                Route::resource('admin/product', 'Admin\ProductController', ['except' => ['show']]);
                Route::get('admin/product/gallery', 'Admin\ProductController@gallery');
                Route::post('admin/product/upload', 'Admin\ProductController@upload');
                Route::post('admin/product/del_product_img/{id}', 'Admin\ProductController@del_product_img');

                //filter_product
                Route::get('admin/filter', 'Admin\FilterController@index');
                Route::post('admin/filter', 'Admin\FilterController@create');
                Route::get('admin/product/add-filter/{id}', 'Admin\ProductController@add_filter_form');
                Route::post('admin/product/add_filter', 'Admin\ProductController@add_filter_product');
                //item-section
                Route::get('admin/item', 'Admin\ItemController@index');
                Route::post('admin/item', 'Admin\ItemController@create');
                Route::get('admin/product/add-item/{id}', 'Admin\ProductController@add_item_form');
                Route::post('admin/product/add_item', 'Admin\ProductController@add_item_product');
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
                //order product
                Route::get('admin/order', 'Admin\OrderController@index')->name('order');
                Route::get('admin/order/{id}', 'Admin\OrderController@view');
                Route::delete('admin/order/{id}', 'Admin\OrderController@destroy');
                Route::post('admin/order/set_status', 'Admin\OrderController@set_status');

                //user managements_status
                Route::resource('admin/user', 'Admin\UserController');
                //admin_statistics
                Route::get('admin/statistics', 'Admin\AdminController@statistics');
                //comment and question users managment
                Route::post('admin/ajax/set_comment_status', 'Admin\CommentController@set_comment_status');
                Route::delete('admin/comment/{id}', 'Admin\CommentController@delete');
                Route::get('admin/question', 'Admin\QuestionController@index');
                Route::get('admin/comment', 'Admin\CommentController@index');
                Route::post('admin/ajax/set_status_question', 'Admin\QuestionController@set_status');
                Route::delete('admin/question/{id}', 'Admin\QuestionController@delete');
                Route::post('admin/question/add', 'Admin\QuestionController@add');
                //setting dargah pardakht
                Route::get('admin/setting/pay', 'Admin\AdminController@pay_setting_form');
                Route::post('admin/setting/pay', 'Admin\AdminController@pay_setting');
                //news section
                Route::resource('admin/news','Admin\NewsController',['except' => ['show']]);
        });

        Route::get('admin_login', 'Admin\AdminController@admin_login');
        Route::middleware(['statistics'])->group(function () {
                Route::get('/', 'SiteController@index')->name('index');
                Route::get('product/{code}/{title}', 'SiteController@show');
                Route::get('Cart', 'SiteController@show_cart')->name('cart');

                Route::get('category/{cat1}', 'SearchController@cat1');
                Route::get('search/{cat1}/{cat2}/{cat3}', 'SearchController@search');



                Route::get('Search', 'SiteController@search');
        });
        //Route::post('customLogin','ShopController@customLogin')->name('custom.login');

        //site controller

        Route::post('site/ajax_set_service', 'SiteController@set_service');

        Route::post('Cart', 'SiteController@cart');
        Route::post('site/ajax_del_cart', 'SiteController@del_cart');
        Route::post('site/ajax_change_cart', 'SiteController@change_cart');
        Route::post('shop/add_address', 'ShopController@add_address');
        Route::post('shop/edit_address_form', 'ShopController@edit_address_form');
        Route::post('shop/edit_address/{address_id}', 'ShopController@edit_address');
        Route::delete('remove_address/{id}', 'ShopController@remove_address');
        Route::match(['get', 'post'], 'review', 'ShopController@review');
        Route::post('payment', 'ShopController@Payment');
        Route::post('Payment', 'ShopController@Pay');
        Route::get('user/order', 'UserController@show_order');
        Route::get('/news/{news}','homeController@single')->name('news.single');
        Route::get('logout', 'Auth\LoginController@logout');


        //search category menu filter product search page
        Route::post('ajax/set_filter_product', 'SearchController@ajax_search');
        Route::get('category/{cat1}/{cat2}', 'SearchController@show_cat1');
        Route::get('category/{cat1}/{cat2}/{cat3}', 'SearchController@show_cat_product');
        Route::get('category/{cat1}/{cat2}/{cat3}/{cat4}', 'SearchController@show_cat4');


        Route::get('Search', 'SiteController@search');

        Auth::routes();

        Route::get('/home', 'SiteController@index')->name('home');
        Route::get('Captcha', function () {
                $Captcha = new \App\lib\Captcha();
                $Captcha->create();
        });
        Route::post('site/ajax_check_login', 'SiteController@check_login');
        Route::get('Shipping', 'ShopController@Shipping');
        Route::post('shop/get_ajax_shahr', 'ShopController@get_ajax_shahr');
        ROute::post('site/check_discount_code','SiteController@check_discount_code');


        //user route
        Route::get('user/order/print', 'UserController@print_order');
        Route::get('user/order/create_barcode', 'UserController@create_barcode');
        Route::get('user/order/pdf', 'UserController@create_pdf');
        Route::post('order', 'ShopController@update_order');
        Route::get('order', 'ShopController@update_order2');

        Route::post('site/ajax_get_tab_data', 'SiteController@get_tab_data');

        Route::middleware(['auth'])->group(function () {
                Route::get('AddComment/{product_id}', 'SiteController@comment_form');
                Route::post('site/add_score', 'SiteController@add_score');
                Route::post('site/add_comment', 'SiteController@add_comment');
                Route::post('add_question', 'SiteController@add_question');
                Route::get('user', 'UserController@index');
                Route::get('user/orders', 'UserController@orders');
                Route::get('user/editAddress', 'UserController@editAdress');
        });
        Route::post('/getData', 'SiteController@ajaxForm');
});
