<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())->group(function() {

    // Admin Routes
    Route::prefix('admin')->name('admin.')->middleware('auth', 'check_user')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('index');

        Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
        Route::get('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
        Route::delete('categories/{id}/forcedelete', [CategoryController::class, 'forcedelete'])->name('categories.forcedelete');
        Route::resource('categories', CategoryController::class);


        // Products routes
        Route::get('products/trash', [ProductController::class, 'trash'])->name('products.trash');
        Route::get('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
        Route::delete('products/{id}/forcedelete', [ProductController::class, 'forcedelete'])->name('products.forcedelete');
        Route::resource('products', ProductController::class);

        // Users Routes
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    });

    // Website Routes
    Auth::routes();

    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::view('not-allowed', 'not_allowed');


    // Website Routes
    Route::get('/', [MainController::class, 'home'])->name('site.index');
    Route::get('/shop', [MainController::class, 'shop'])->name('site.shop');
    Route::get('/category/{id}', [MainController::class, 'category'])->name('site.category');
    Route::get('/search', [MainController::class, 'search'])->name('site.search');
    Route::get('/product/{id}', [MainController::class, 'product'])->name('site.product');

    Route::post('add-to-cart', [CartController::class, 'add_to_cart'])->name('site.add_to_cart');

});

