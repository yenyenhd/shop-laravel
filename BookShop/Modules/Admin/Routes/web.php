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

Route::group(['prefix' => 'laravel-filemanager' ], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
Route::prefix('admin')->group(function() {
    Route::get('/', 'AdminController@index')->name('index');
    Route::post('/', 'AdminController@login')->name('admin.login');
    Route::get('/', 'AdminController@logout')->name('admin.logout');
    Route::get('404', 'AdminController@error')->name('login');


    Route::group(['middleware' => ['auth']], function() {
        Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
        Route::post('/filter-by-date','AdminController@filter_by_date');
        Route::post('/dashboard-filter','AdminController@dashboard_filter');
        Route::post('/days-order','AdminController@days_order');

        // Slider
        Route::prefix('slider')->group(function () {
            Route::get('/', 'AdminSliderController@index')->name('list.slider');
            Route::get('/create', 'AdminSliderController@create')->name('slider.add');
            Route::post('/create', 'AdminSliderController@store')->name('slider.store');
            Route::get('/update/{id}', 'AdminSliderController@edit')->name('slider.edit');
            Route::post('/update/{id}', 'AdminSliderController@update')->name('slider.update');
            Route::get('/{action}/{id}', 'AdminSliderController@action')->name('slider.action');
            Route::post('/import-csv','AdminSliderController@import_csv')->name('slider.import_csv');
            Route::post('/export-csv','AdminSliderController@export_csv')->name('slider.export_csv');
        });

        // Banner
        Route::prefix('banner')->group(function () {
            Route::get('/', 'AdminBannerController@index')->name('list.banner');
            Route::get('/create', 'AdminBannerController@create')->name('banner.add');
            Route::post('/create', 'AdminBannerController@store')->name('banner.store');
            Route::get('/update/{id}', 'AdminBannerController@edit')->name('banner.edit');
            Route::post('/update/{id}', 'AdminBannerController@update')->name('banner.update');
            Route::get('/{action}/{id}', 'AdminBannerController@action')->name('banner.action');
            Route::post('/import-csv','AdminBannerController@import_csv')->name('banner.import_csv');
            Route::post('/export-csv','AdminBannerController@export_csv')->name('banner.export_csv');
        });

        // Category
        Route::prefix('category')->group(function () {
            Route::get('/', 'AdminCategoryController@index')->name('list.category');
            Route::get('/create', 'AdminCategoryController@create')->name('category.add');
            Route::post('/create', 'AdminCategoryController@store')->name('category.store');
            Route::get('/update/{id}', 'AdminCategoryController@edit')->name('category.edit');
            Route::post('/update/{id}', 'AdminCategoryController@update')->name('category.update');
            Route::get('/{action}/{id}', 'AdminCategoryController@action')->name('category.action');
            Route::post('/import-csv','AdminCategoryController@import_csv')->name('category.import_csv');
            Route::post('/export-csv','AdminCategoryController@export_csv')->name('category.export_csv');
        });

        // Product
        Route::prefix('product')->group(function () {
            Route::get('/', 'AdminProductController@index')->name('list.product');
            Route::get('/create', 'AdminProductController@create')->name('product.add');
            Route::post('/create', 'AdminProductController@store')->name('product.store');
            Route::get('/update/{id}', 'AdminProductController@edit')->name('product.edit');
            Route::post('/update/{id}', 'AdminProductController@update')->name('product.update');
            Route::get('/{action}/{id}', 'AdminProductController@action')->name('product.action');
            Route::post('/import-csv','AdminProductController@import_csv')->name('product.import_csv');
            Route::post('/export-csv','AdminProductController@export_csv')->name('product.export_csv');
        });

         // Post
         Route::prefix('post')->group(function () {
            Route::get('/', 'AdminPostController@index')->name('list.post');
            Route::get('/create', 'AdminPostController@create')->name('post.add');
            Route::post('/create', 'AdminPostController@store')->name('post.store');
            Route::get('/update/{id}', 'AdminPostController@edit')->name('post.edit');
            Route::post('/update/{id}', 'AdminPostController@update')->name('post.update');
            Route::get('/{action}/{id}', 'AdminPostController@action')->name('post.action');
            Route::post('/import-csv','AdminPostController@import_csv')->name('post.import_csv');
            Route::post('/export-csv','AdminPostController@export_csv')->name('post.export_csv');
        });

        // Coupon
        Route::prefix('coupon')->group(function () {
            Route::get('/', 'AdminCouponController@index')->name('list.coupon');
            Route::get('/create', 'AdminCouponController@create')->name('coupon.add');
            Route::post('/create', 'AdminCouponController@store')->name('coupon.store');
            Route::get('/update/{id}', 'AdminCouponController@edit')->name('coupon.edit');
            Route::post('/update/{id}', 'AdminCouponController@update')->name('coupon.update');
            Route::get('/destroy/{id}', 'AdminCouponController@destroy')->name('coupon.destroy');
            Route::post('/import-csv','AdminCouponController@import_csv')->name('coupon.import_csv');
            Route::post('/export-csv','AdminCouponController@export_csv')->name('coupon.export_csv');
        });

        // Delivery
        Route::prefix('delivery')->group(function () {
            Route::get('/', 'AdminDeliveryController@index')->name('list.delivery');
            Route::post('/select', 'AdminDeliveryController@select_delivery')->name('delivery.select');
            Route::post('/create', 'AdminDeliveryController@create')->name('delivery.create');
            Route::post('/select-feeship', 'AdminDeliveryController@select_feeship')->name('delivery.select_feeship');
            Route::post('/update-delivery', 'AdminDeliveryController@update_delivery')->name('delivery.update_delivery');
        });
        
    
        // Order
        Route::prefix('order')->group(function () {
            Route::get('/', 'AdminOrderController@index')->name('list.order');
            Route::get('/view/{code}', 'AdminOrderController@view_order')->name('order.view');
            Route::get('/print-order/{code}', 'AdminOrderController@print_order')->name('order.print');
            Route::post('/update-qty', 'AdminOrderController@update_qty');
            Route::post('/update-order-qty', 'AdminOrderController@update_order_quantity')->name('order.update_quantity');
            Route::get('/{action}/{id}', 'AdminCommentController@action')->name('order.action');


            
        });
        // Comment
        Route::prefix('comment')->group(function () {
            Route::get('/', 'AdminCommentController@index')->name('list.comment');
            Route::get('/{action}/{id}', 'AdminCommentController@action')->name('comment.action');
            
        });
        // Contact
        Route::prefix('contact')->group(function () {
            Route::get('/', 'AdminContactController@index')->name('contact.index');
            Route::get('/create', 'AdminContactController@create')->name('contact.add');
            Route::post('/save-info', 'AdminContactController@save_info')->name('contact.save');
            Route::get('/update/{id}', 'AdminContactController@edit')->name('contact.edit');
            Route::post('/update/{id}', 'AdminContactController@update')->name('contact.update');
            
        });
        
        // User
        Route::prefix('user')->group(function () {
            Route::get('/', 'AdminUserController@index')->name('list.user');
            Route::get('/create', 'AdminUserController@create')->name('user.add');
            Route::post('/create', 'AdminUserController@store')->name('user.store');
            Route::get('/update/{id}', 'AdminUserController@edit')->name('user.edit');
            Route::post('/update/{id}', 'AdminUserController@update')->name('user.update');
            Route::get('/destroy/{id}', 'AdminUserController@destroy')->name('user.destroy');
        });

        // Role
        Route::prefix('role')->group(function () {
            Route::get('/', 'AdminRoleController@index')->name('list.role');
            Route::get('/create', 'AdminRoleController@create')->name('role.add');
            Route::post('/create', 'AdminRoleController@store')->name('role.store');
            Route::get('/update/{id}', 'AdminRoleController@edit')->name('role.edit');
            Route::post('/update/{id}', 'AdminRoleController@update')->name('role.update');
            Route::get('/destroy/{id}', 'AdminRoleController@destroy')->name('role.destroy');
        });

        // Permission
        Route::prefix('permission')->group(function () {
            Route::get('/', 'AdminPermissionController@create')->name('permission.add');
            Route::post('/', 'AdminPermissionController@store')->name('permission.store');
            Route::post('/save', 'AdminPermissionController@save')->name('permission.save');
        });
    });
 
});
