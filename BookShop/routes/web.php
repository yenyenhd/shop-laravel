<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContactController;





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
// Home
Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/gioi-thieu', [HomeController::class,'about'])->name('about');
Route::post('/search', [HomeController::class, 'search'])->name('search');
Route::post('/autocomplete-ajax', [HomeController::class, 'autocomplete_ajax']);
Route::post('/product-tabs',[HomeController::class, 'product_tabs']);
Route::post('/load-more-product',[HomeController::class,'load_more_product']);


// Product
Route::get('/product-detail/{slug}', [ProductController::class, 'product_detail'])->name('product_detail');
Route::get('/tag/{product_tag}', [ProductController::class, 'tag'])->name('product_tag');
Route::post('/quickview', [ProductController::class, 'quickview']);
Route::get('/category/{slug}', [ProductController::class, 'show_category_home'])->name('category.slug');


// Comment
Route::post('/send-comment',[CommentController::class, 'send_comment']);
Route::post('/insert-rating',[CommentController::class, 'insert_rating']);
Route::post('/reply-comment/{product_id}', [CommentController::class, 'reply_comment'])->name('reply_comment');


// Cart
Route::get('/cart', [CartController::class, 'show_cart'])->name('show_cart');
// Route::post('/cart', [CartController::class, 'cart'])->name('cart_product');
Route::get('/delete-cart/{rowId}', [CartController::class, 'delete'])->name('delete_cart');
Route::post('/update-cart', [CartController::class, 'update'])->name('update_cart');

Route::post('/add-cart-ajax',[CartController::class, 'add_cart_ajax']);
Route::post('/update-cart-ajax', [CartController::class, 'update_ajax'])->name('update_cart_ajax');
Route::get('/delete-cart-ajax/{session_id}', [CartController::class, 'delete_ajax'])->name('delete_cart_ajax');
Route::get('/delete-all', [CartController::class, 'delete_all'])->name('delete_all');
Route::get('/show_quick_cart', [CartController::class, 'show_quick_cart']);
Route::post('/update-quick-cart',[CartController::class, 'update_quick_cart']);
Route::get('/cart-session',[CartController::class, 'cart_session']);

Route::get('/show-cart',[CartController::class, 'show_cart_menu']);
Route::get('/hover-cart',[CartController::class, 'hover_cart']);
Route::get('/remove-item',[CartController::class, 'remove_item']);


// Coupon
Route::post('/check-coupon',[CouponController::class, 'check_coupon'])->name('check_coupon');
Route::get('/delete-coupon',[CouponController::class, 'delete_coupon'])->name('delete_coupon');

// Customer
Route::get('/add-customer', [CustomerController::class,'add_customer'])->name('add_customer');
Route::post('/add-customer', [CustomerController::class,'store'])->name('customer.store');
Route::get('/login-checkout', [CustomerController::class, 'login_checkout'])->name('login_checkout');
Route::post('/login-checkout', [CustomerController::class, 'login'])->name('customer.login');
Route::get('/logout', [CustomerController::class, 'logout'])->name('logout');

// Checkout

Route::get('/checkout', [CheckoutController::class,'checkout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class,'list_address']);
Route::post('/billing-address', [CheckoutController::class,'billing_address'])->name('billing_address');
Route::post('/send-address', [CheckoutController::class,'insert_address']);
Route::post('/select-address', [CheckoutController::class,'select_address']);
Route::post('/confirm-order', [CheckoutController::class,'confirm_order']);

// Order
Route::get('/history',[OrderController::class, 'history']);
Route::get('/view-history-order/{order_code}',[OrderController::class, 'view_history_order']);
Route::post('/cancel-order',[OrderController::class, 'cancel_order']);

// Post
Route::get('/post', [PostController::class, 'post'])->name('blog');
Route::get('/post-detail/{slug}', [PostController::class, 'post_detail'])->name('blog.detail');

// Contact
Route::get('/contact',[ContactController::class, 'contact'])->name('contact');

