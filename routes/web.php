<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::middleware(['role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users/store', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::resource('brands', BrandController::class, ['as' => 'admin']);
    Route::resource('categories', CategoryController::class, ['as' => 'admin']);
    Route::resource('products', ProductController::class, ['as' => 'admin']);
});

Route::middleware(['role:user'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
});

Route::get('/force-logout', function() {
    Auth::logout();
    return redirect('/');
});
