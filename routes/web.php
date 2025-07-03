<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaptopController;

Route::get('/', function () {
    return redirect()->route('laptops.index');
});

Route::get('/product-detail/{id}', [LaptopController::class, 'show'])->name('product.show');
Route::get('/laptops', [LaptopController::class, 'index'])->name('laptops.index');
Route::get('/laptops/{id}', [LaptopController::class, 'show'])->name('laptops.show');
