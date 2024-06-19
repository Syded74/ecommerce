<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'showWelcomePage'])->name('welcome');

Auth::routes();

Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['role:super-admin'])->group(function () {
    Route::get('/super-admin', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/super-admin/create-admin', [SuperAdminController::class, 'createAdmin'])->name('superadmin.createAdmin');
    Route::post('/super-admin/store-admin', [SuperAdminController::class, 'storeAdmin'])->name('superadmin.storeAdmin');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/brands', [BrandController::class, 'index'])->name('brands');
    Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy'); // Add this line
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::get('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
});

Route::get('/force-logout', function() {
    Auth::logout();
    return redirect('/');
});
