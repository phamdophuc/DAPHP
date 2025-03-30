<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Routes for Products
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');

    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
});

// Routes for Categories
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');

    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/{id}', [CategoryController::class, 'show'])->name('categories.show');
});

// Routes for Brands
Route::prefix('brands')->group(function () {
    Route::get('/', [BrandController::class, 'index'])->name('brands.index');
    Route::get('/create', [BrandController::class, 'create'])->name('brands.create');
    Route::post('/', [BrandController::class, 'store'])->name('brands.store');

    Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brands.edit');
    Route::put('/{id}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');

    Route::get('/{id}', [BrandController::class, 'show'])->name('brands.show');
});

// Routes for Orders
Route::prefix('orders')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/', [OrderController::class, 'store'])->name('orders.store');

    Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/{id}', [OrderController::class, 'update'])->name('orders.update');
    Route::delete('/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
});

// Routes for OrderDetails
Route::prefix('order-details')->group(function () {
    Route::get('/', [OrderDetailController::class, 'index'])->name('order-details.index');
    Route::get('/create', [OrderDetailController::class, 'create'])->name('order-details.create');
    Route::post('/', [OrderDetailController::class, 'store'])->name('order-details.store');

    Route::get('/edit/{id}', [OrderDetailController::class, 'edit'])->name('order-details.edit');
    Route::put('/{id}', [OrderDetailController::class, 'update'])->name('order-details.update');
    Route::delete('/{id}', [OrderDetailController::class, 'destroy'])->name('order-details.destroy');

    Route::get('/{id}', [OrderDetailController::class, 'show'])->name('order-details.show');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('/register', [AuthenticatedSessionController::class, 'createRegister'])->name('register');
    Route::post('/register', [AuthenticatedSessionController::class, 'storeRegister']);
});

require __DIR__.'/auth.php';
