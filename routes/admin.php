<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\Admin\BusinessSettingsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;

Route::middleware(['admin.log'])->group(function () {

    Route::get('/admin', [DashboardController::class, 'admin_dashboard'])
        ->name('admin.dashboard')
        ->middleware(['auth', 'admin']);

    Route::post('/admin/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/logs', [LogController::class, 'index'])->name('admin.logs');

    // Products
    Route::get('/products/admin', [ProductController::class, 'admin_products'])->name('products.admin');
    Route::get('/products/seller', [ProductController::class, 'seller_products'])->name('products.seller');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/admin/{id}/edit', [ProductController::class, 'admin_product_edit'])->name('products.admin.edit');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/seller/{id}/edit', [ProductController::class, 'seller_product_edit'])->name('products.seller.edit');
    Route::post('/products/todays_deal', [ProductController::class, 'updateTodaysDeal'])->name('products.todays_deal');
    Route::post('/products/get_products_by_subsubcategory', [ProductController::class, 'get_products_by_subsubcategory'])->name('products.get_products_by_subsubcategory');

    // Business Settings
    Route::post('/business-settings/update', [BusinessSettingsController::class, 'update'])->name('business_settings.update');

    // Currency Settings
    Route::get('/currency', [CurrencyController::class, 'index'])->name('currency.index');
    Route::post('/currency/update', [CurrencyController::class, 'updateStatus'])->name('currency.update');
    Route::post('/your-currency/update', [CurrencyController::class, 'update'])->name('your_currency.update');
    Route::get('/currency/create', [CurrencyController::class, 'create'])->name('currency.create');
    Route::post('/currency/store', [CurrencyController::class, 'store'])->name('currency.store');
    Route::post('/currency/currency_edit', [CurrencyController::class, 'edit'])->name('currency.edit');
    Route::post('/currency/update_status', [CurrencyController::class, 'update_status'])->name('currency.update_status');

    // Coupons
    // Route::resource('coupon', CouponController::class);
    // Route::post('/coupon/get_form', [CouponController::class, 'get_coupon_form'])->name('coupon.get_coupon_form');
    // Route::post('/coupon/get_form_edit', [CouponController::class, 'get_coupon_form_edit'])->name('coupon.get_coupon_form_edit');
    // Route::get('/coupon/destroy/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');
});
