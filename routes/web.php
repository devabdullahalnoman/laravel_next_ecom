<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BuyerDashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerApplicationController;
use App\Http\Controllers\SellerDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name('product.index');

Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::put('/admin/users/{user}', [AdminDashboardController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminDashboardController::class, 'deleteUser'])->name('admin.users.destroy');
    Route::delete('/admin/products/{product}', [AdminDashboardController::class, 'deleteProduct'])->name('admin.products.destroy');
    Route::get('/admin/products/{product}/orders', [AdminDashboardController::class, 'productOrders'])->name('admin.products.orders');
    Route::put('/admin/applications/{application}', [SellerApplicationController::class, 'update'])->name('admin.applications.update');
    Route::delete('/admin/applications/{application}', [SellerApplicationController::class, 'destroy'])->name('admin.applications.destroy');
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [SellerDashboardController::class, 'index'])->name('seller.dashboard');
    Route::resource('seller/product', SellerDashboardController::class)
        ->names('seller.product');
    Route::patch('/orders/{order}/status', [SellerDashboardController::class, 'updateOrderStatus'])
        ->name('seller.order.updateStatus');
});

Route::middleware(['auth', 'role:buyer'])->group(function () {
    Route::get('/buyer/dashboard', [BuyerDashboardController::class, 'index'])->name('buyer.dashboard');
    Route::post('/products/{product}/order', [OrderController::class, 'store'])->name('order.store');
    Route::get('/products/{product}/checkout', [OrderController::class, 'create'])->name('order.create');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/buyer/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/buyer/cart/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('/buyer/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/buyer/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/buyer/cart/checkout/{product}', [OrderController::class, 'createFromCart'])->name('cart.checkout');
    Route::post('/buyer/cart/checkout/{product}', [OrderController::class, 'storeFromCart'])->name('cart.checkout.submit');
    Route::get('/buyer/apply-seller', [SellerApplicationController::class, 'create'])->name('seller.apply');
    Route::post('/buyer/apply-seller', [SellerApplicationController::class, 'store'])->name('seller.apply.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
