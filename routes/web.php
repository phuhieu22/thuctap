<?php

use App\Http\Controllers\LaptopController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->name('admin.')->group(function () {
    
    // Trang Dashboard
    Route::get('/', function () {
        $stats = [
            'total_laptops' => \App\Models\Laptop::count(),
            'total_categories' => \App\Models\Category::count(),
            'total_variants' => \App\Models\LaptopVariant::count(),
            'low_stock_items' => \App\Models\Laptop::where('stock', '<', 10)->count(),
        ];
        
        $recent_laptops = \App\Models\Laptop::with(['brand', 'category'])
            ->latest()
            ->take(5)
            ->get();
            
        return view('admin.dashboard', compact('stats', 'recent_laptops'));
    })->name('dashboard');

    Route::resource('laptops', LaptopController::class);

    Route::resource('categories', CategoryController::class);

});
Route::get('laptops-search', [LaptopController::class, 'search'])->name('laptops.search');