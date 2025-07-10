<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LaptopController;

Route::get('/', function () {
    return redirect()->route('laptops.index');
});

Route::get('/product-detail/{id}', [LaptopController::class, 'show'])->name('product.show');
Route::get('/laptops', [LaptopController::class, 'index'])->name('laptops.index');
Route::get('/laptops/{id}', [LaptopController::class, 'show'])->name('laptops.show');

// Giỏ hàng
Route::prefix('cart')->name('cart.')->group(function () {
    Route::post('/add', [CartController::class, 'addToCart'])->name('add');
    Route::get('/', [CartController::class, 'viewCart'])->name('view');
    Route::patch('/{id}/update', [CartController::class, 'updateQuantity'])->name('update');
    Route::delete('/{id}/remove', [CartController::class, 'remove'])->name('remove');
});



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])->name('forgot.form');
Route::post('/forgot-password', [AuthController::class, 'handleForgot'])->name('forgot');


Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');


Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
