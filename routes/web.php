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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\UserProfileController;


Route::get('/', [HomeController::class, 'showWelcomePage'])->name('welcome');

Auth::routes();

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:super-admin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('dashboard');
    Route::get('/create-admin', [SuperAdminController::class, 'createAdmin'])->name('createAdmin');
    Route::post('/store-admin', [SuperAdminController::class, 'storeAdmin'])->name('storeAdmin');
    Route::delete('/delete-admin/{admin}', [SuperAdminController::class, 'deleteAdmin'])->name('deleteAdmin');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

 // Product routes
 Route::get('/products', [ProductController::class, 'index'])->name('products.index');
 Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
 Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
 Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
 Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
 Route::patch('/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
 Route::delete('/products/{product}/forceDelete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
 

     // Brand routes
     Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
     Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
     Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
     Route::get('/brands/{brand}', [BrandController::class, 'show'])->name('brands.show');
     Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
     Route::patch('/brands/{brand}/restore', [BrandController::class, 'restore'])->name('brands.restore');
     Route::delete('/brands/{brand}/force-delete', [BrandController::class, 'forceDelete'])->name('brands.forceDelete');
     Route::patch('/brands/{brand}/update-status', [BrandController::class, 'updateStatus'])->name('brands.updateStatus');

 // Category routes
 Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
 Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
 Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
 Route::patch('/categories/{category}/status', [CategoryController::class, 'updateStatus'])->name('categories.updateStatus');
 Route::patch('/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
 Route::delete('/categories/{category}/forceDelete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
 Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

 // User routes
 Route::get('/users', [UserController::class, 'index'])->name('users.index');
 Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
 Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
 Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');  // Ensure this route is added
 Route::patch('/users/{user}/status', [UserController::class, 'updateStatus'])->name('users.updateStatus');
 Route::patch('/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');  // Ensure this route is added
 Route::delete('/users/{user}/forceDelete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
 Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

 // Admin profile routes
 Route::get('profile', [AdminProfileController::class, 'show'])->name('admin.profile.show');
 Route::get('profile/edit', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
 Route::patch('profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');
  //Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::patch('/orders/{order}/restore', [OrderController::class, 'restore'])->name('orders.restore');
    Route::delete('/orders/{order}/forceDelete', [OrderController::class, 'forceDelete'])->name('orders.forceDelete');
    Route::patch('/orders/{order}/updateStatus', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});


Route::middleware(['auth'])->group(function () {
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

// routes/web.php

// User dashboard route
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/dashboard', [UserController::class, 'show'])->name('user.show');
    Route::post('/cart/add/{product}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/view', [App\Http\Controllers\CartController::class, 'viewCart'])->name('cart.view');
    Route::get('/cart/remove/{id}', [App\Http\Controllers\CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/place-order', [OrderController::class, 'placeOrder'])->name('order.place');


 Route::get('profile', [UserProfileController::class, 'show'])->name('profile.show');
 Route::get('profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
 Route::patch('profile/update', [UserProfileController::class, 'update'])->name('profile.update');
});


Route::get('/force-logout', function() {
    Auth::logout();
    return redirect('/');
});
