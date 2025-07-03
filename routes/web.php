<?php

use App\Http\Controllers\LaptopController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// Route::resource('laptops', LaptopController::class);
// Route::resource('categories', CategoryController::class);

// Route::get('/admin', function () {
//     return view('admin.dashboard');
// })->name('admin.dashboard');

// Route::get('laptops', [LaptopController::class, 'index'])->name('laptops.index');
// Route::get('laptops/create', [LaptopController::class, 'create'])->name('laptops.create');
// Route::get('laptops/{laptop}', [LaptopController::class, 'show'])->name('laptops.show');
// Route::get('laptops/{laptop}/edit', [LaptopController::class, 'edit'])->name('laptops.edit');

// // POST routes
// Route::post('laptops', [LaptopController::class, 'store'])->name('laptops.store');

// // PUT/PATCH routes
// Route::put('laptops/{laptop}', [LaptopController::class, 'update'])->name('laptops.update');
// Route::patch('laptops/{laptop}', [LaptopController::class, 'update'])->name('laptops.update');

// // DELETE routes
// Route::delete('laptops/{laptop}', [LaptopController::class, 'destroy'])->name('laptops.destroy');

// // Custom search route
// Route::get('laptops-search', [LaptopController::class, 'search'])->name('laptops.search');

// // GET routes
// Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
// Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
// Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
// Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

// // POST routes
// Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');

// // PUT/PATCH routes
// Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
// Route::patch('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

// // DELETE routes
// Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Trang Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Route cho CRUD Laptops (tự động tạo 7 route)
    Route::resource('laptops', LaptopController::class);

    // Route cho CRUD Categories (tự động tạo 7 route)
    Route::resource('categories', CategoryController::class);

    // Nếu có các route đặc biệt khác, bạn có thể thêm vào đây
    // Ví dụ: Route::post('laptops/{laptop}/restore', [LaptopController::class, 'restore'])->name('laptops.restore');
});
Route::get('laptops-search', [LaptopController::class, 'search'])->name('laptops.search');