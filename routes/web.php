<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', [AuthController::class, 'redirectLogged'])->name(name: 'home');
Route::get('/customer_product_list', [CustomerController::class, 'product_list'])->name('customer_product_list');
Route::get('/customer_product_detail/{id}', [CustomerController::class, 'product_detail'])->name('customer_product_detail');

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/google_redirect', [AuthController::class, 'google_redirect'])->name('google_redirect');
    Route::get('/google_signin', [AuthController::class, 'google_signin'])->name('google_signin');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
    Route::post('/signup', [AuthController::class, 'createUser'])->name('signup');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', \App\Http\Middleware\Role::class . ':1']], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::post('/admin_widget_get', [AdminController::class, 'widget_get'])->name('admin_widget_get');
    Route::get('/admin_product_list', [AdminController::class, 'product_list'])->name('admin_product_list');
    Route::get('/admin_product_add', [AdminController::class, 'product_add'])->name('admin_product_add');
    Route::post('/admin_product_insert', [AdminController::class, 'product_insert'])->name('admin_product_insert');
    Route::get('/admin_product_delete/{id}', [AdminController::class, 'product_delete'])->name('admin_product_delete');
    Route::get('/admin_product_edit/{id}', [AdminController::class, 'product_edit'])->name('admin_product_edit');
    Route::post('/admin_product_update', [AdminController::class, 'product_update'])->name('admin_product_update');

    Route::get('/admin_user_list', [AdminController::class, 'user_list'])->name('admin_user_list');
    Route::get('/admin_user_edit/{id}', [AdminController::class, 'user_edit'])->name('admin_user_edit');
    Route::post('/admin_user_update', [AdminController::class, 'user_update'])->name('admin_user_update');
    Route::get('/admin_user_delete/{id}', [AdminController::class, 'user_delete'])->name('admin_user_delete');

    Route::get('/admin_order_list', [AdminController::class, 'order_list'])->name('admin_order_list');
    Route::get('/admin_order_history_list', [AdminController::class, 'order_history_list'])->name('admin_order_history_list');
    Route::get('/admin_order_detail/{id}', [AdminController::class, 'order_detail'])->name('admin_order_detail');
    Route::get('/admin_order_cancel/{id}', [AdminController::class, 'order_cancel'])->name('admin_order_cancel');
    Route::post('/admin_order_finish', [AdminController::class, 'order_finish'])->name('admin_order_finish');
    Route::get('/admin_profile', [AdminController::class, 'profile'])->name('admin_profile');
    Route::get('/admin_report_list', [AdminController::class, 'report_list'])->name('admin_report_list');
    Route::get('/admin_report_export', [AdminController::class, 'report_export'])->name('admin_report_export');
    Route::get('/admin_report_export/{year}/{month}', [AdminController::class, 'report_export'])->name('admin_report_export');
});

Route::group(['middleware' => ['auth', \App\Http\Middleware\Role::class . ':2']], function () {
    Route::get('/customer', [CustomerController::class, 'home'])->name('customer');
    Route::get('/customer_profile', [CustomerController::class, 'profile'])->name('customer_profile');
    Route::get('/customer_detail_product/{id}', [CustomerController::class, 'detail_product'])->name('customer_detail_product');
    Route::get('/customer_cart_list', [CustomerController::class, 'cart_list'])->name('customer_cart_list');
    Route::post('/customer_cart_add', [CustomerController::class, 'cart_add'])->name('customer_cart_add');
    Route::get('/customer_cart_delete/{id}', [CustomerController::class, 'cart_delete'])->name('customer_cart_delete');
    Route::get('/customer_cart_delete_sync/{id}', [CustomerController::class, 'cart_delete_sync'])->name('customer_cart_delete_sync');
    Route::get('/customer_order_now/{id}/{amount}/{game_id}', [CustomerController::class, 'order_now'])->name(name: 'customer_order_now');
    Route::get('/customer_order_cart', [CustomerController::class, 'order_cart'])->name('customer_order_cart');
    Route::post('/customer_order_add_now', [CustomerController::class, 'order_add_now'])->name('customer_order_add_now');
    Route::get('/customer_order_list', [CustomerController::class, 'order_list'])->name('customer_order_list');
    Route::get('/customer_order_detail/{id}', [CustomerController::class, 'order_detail'])->name('customer_order_detail');
    Route::get('/customer_order_cancel/{id}', [CustomerController::class, 'order_cancel'])->name('customer_order_cancel');
    Route::post('/customer_order_payment', [CustomerController::class, 'order_payment'])->name('customer_order_payment');
    Route::post('/customer_order_review', [CustomerController::class, 'order_review'])->name('customer_order_review');
    Route::get('/customer_order_rating/{id}', [CustomerController::class, 'order_rating'])->name('customer_order_rating');
    Route::post('/customer_checkout', [CustomerController::class, 'checkout'])->name('customer_checkout');

    Route::get('/customer_process', [CustomerController::class, 'customer_process'])->name('customer_process');
    Route::post('/customer_get_product', [CustomerController::class, 'get_product'])->name('customer_get_product');
    Route::get('/customer/invoices', [CustomerController::class, 'invoiceList'])->name('customer.invoices');
    Route::get('/customer/invoice/{id}', [CustomerController::class, 'productInvoice'])->name('customer.invoice');

    Route::get('/customer_detail/{id}', [CustomerController::class, 'customerDetail'])->name('customer_detail');
    Route::post('/customer_detail/profile/{id}/update', [CustomerController::class, 'customerDetailUpdate'])->name('customer_detail_update');
    Route::post('/customer_detail/security/{id}/update', [CustomerController::class, 'customerSecurityUpdate'])->name('customer_security_update');
});
