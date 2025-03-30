<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\Auth\RegisteredUserController;

use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::resource('/categories', CategoryController::class)->names('admin.categories');
    Route::resource('/brands', BrandController::class)->names('admin.brands');
    Route::resource('/orders', OrderController::class)->names('admin.orders');
    Route::resource('/order-details', OrderDetailController::class)->names('admin.order-details');
});

Route::middleware(['auth', 'role:user'])->prefix('user')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('user.products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('user.products.show');
    Route::post('/products/{id}/add-to-cart', [ProductController::class, 'addToCart'])->name('user.products.addToCart');
    Route::get('/cart', [ProductController::class, 'cart'])->name('user.cart');
    Route::post('/cart/update', [ProductController::class, 'updateCart'])->name('user.cart.update');
    Route::post('/cart/remove', [ProductController::class, 'removeFromCart'])->name('user.cart.remove');
    Route::post('/cart/checkout', [ProductController::class, 'checkout'])->name('user.cart.checkout');
    Route::get('/orders', [OrderController::class, 'index'])->name('user.orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('user.orders.store');
    Route::get('/orders/{id}/details', [OrderDetailController::class, 'show'])->name('user.orders.details');
    Route::get('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('user.orders.cancel');
    Route::get('/orders/{id}/confirm', [OrderController::class, 'confirm'])->name('user.orders.confirm');
    Route::get('/orders/{id}/complete', [OrderController::class, 'complete'])->name('user.orders.complete');
    Route::get('/orders/{id}/return', [OrderController::class, 'return'])->name('user.orders.return');
    Route::get('/orders/{id}/review', [OrderController::class, 'review'])->name('user.orders.review');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

// Load các route authentication khác
require __DIR__.'/auth.php';
