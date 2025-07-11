<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\ResetPasswordController;

Route::get('/', function () {
    return redirect()->route('laptops.index');
});

Route::get('/product-detail/{id}', [LaptopController::class, 'show'])->name('product.show');
Route::get('/laptops', [LaptopController::class, 'index'])->name('laptops.index');
Route::get('/laptops/{id}', [LaptopController::class, 'show'])->name('laptops.show');


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

Route::prefix('admin')->name('admin.')->group(function () {

    // Trang dashboard chính
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Route cho Variants (chỉ gồm: index, show, create, edit, destroy)
    Route::prefix('variants')->name('variants.')->group(function(){
        Route::get('/', [VariantController::class, 'index'])->name('index');
        Route::get('/create', [VariantController::class, 'create'])->name('create');
        Route::post('/store', [VariantController::class, 'store'])->name('store');
        Route::get('/{id}/show', [VariantController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [VariantController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [VariantController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [VariantController::class, 'destroy'])->name('destroy');
    });

});