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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Notifications\CustomerOrderNotification;
use App\Models\User;
use App\Models\Order;





// Public routes
Route::get('/', [HomeController::class, 'showWelcomePage'])->name('welcome');
Auth::routes();

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Forgot Password Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password Routes
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Super Admin routes
Route::middleware(['auth', 'role:super-admin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [SuperAdminController::class, 'index'])->name('dashboard');
    Route::get('/create-admin', [SuperAdminController::class, 'createAdmin'])->name('createAdmin');
    Route::post('/store-admin', [SuperAdminController::class, 'storeAdmin'])->name('storeAdmin');
    Route::delete('/delete-admin/{admin}', [SuperAdminController::class, 'deleteAdmin'])->name('deleteAdmin');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Product routes
    Route::resource('products', ProductController::class)->except(['edit', 'update']);
    Route::patch('/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');
    Route::delete('/products/{product}/force-delete', [ProductController::class, 'forceDelete'])->name('products.forceDelete');

    // Brand routes
    Route::resource('brands', BrandController::class)->except(['edit', 'update']);
    Route::patch('/brands/{brand}/restore', [BrandController::class, 'restore'])->name('brands.restore');
    Route::delete('/brands/{brand}/force-delete', [BrandController::class, 'forceDelete'])->name('brands.forceDelete');
    Route::patch('/brands/{brand}/update-status', [BrandController::class, 'updateStatus'])->name('brands.updateStatus');

    // Category routes
    Route::resource('categories', CategoryController::class)->except(['edit', 'update']);
    Route::patch('/categories/{category}/status', [CategoryController::class, 'updateStatus'])->name('categories.updateStatus');
    Route::patch('/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

    // User management routes
    Route::resource('users', UserController::class)->except(['edit', 'update']);
    Route::patch('/users/{user}/status', [UserController::class, 'updateStatus'])->name('users.updateStatus');
    Route::patch('/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{user}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');

   // Admin profile routes
   Route::get('/admin-profile', [AdminProfileController::class, 'show'])->name('admin-profile.show');
    Route::get('/admin-profile/edit', [AdminProfileController::class, 'edit'])->name('admin-profile.edit');
    Route::put('/admin-profile', [AdminProfileController::class, 'update'])->name('admin-profile.update');

    // Order routes
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'destroy']);
    Route::patch('/orders/{order}/restore', [OrderController::class, 'restore'])->name('orders.restore');
    Route::delete('/orders/{order}/force-delete', [OrderController::class, 'forceDelete'])->name('orders.forceDelete');
    Route::patch('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// User routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Cart routes
    Route::post('/cart/add/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/place-order', [OrderController::class, 'placeOrder'])->name('order.place');

    // User profile routes
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');

    // Checkout routes
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::post('/checkout/complete', [CheckoutController::class, 'complete'])->name('checkout.complete');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Payment routes
Route::get('/payment', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

// Force logout route
Route::get('/force-logout', function() {
    Auth::logout();
    return redirect('/');
});

Route::get('/test-mail', function () {
    Mail::raw('Test email content', function ($message) {
        $message->to('test@example.com')
                ->subject('Test Email');
    });
    return 'Test email sent!';
});

Route::get('/test-notification', function () {
    $user = User::first();
    $order = Order::first();
    
    if (!$user || !$order) {
        return "No user or order found for testing.";
    }

    try {
        $user->notify(new CustomerOrderNotification($order));
        return "Notification sent successfully. Check Mailtrap.";
    } catch (\Exception $e) {
        return "Error sending notification: " . $e->getMessage();
    }
});




// Test route
Route::get('/test-route', function () {
    return 'Test route is working';
})->name('test.route');

