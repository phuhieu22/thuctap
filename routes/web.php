<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;





Route::get('/', function () {
    return redirect()->route('laptops.index');
});

// Trang chủ và trang sản phẩm
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/contact', fn() => view('contact'))->name('contact');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::middleware('auth')->post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');


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

    // Route cho Variants (chỉ gồm: index, show, create, edit, destroy)
    Route::prefix('variants')->name('variants.')->group(function () {
        Route::get('/', [VariantController::class, 'index'])->name('index');
        Route::get('/create', [VariantController::class, 'create'])->name('create');
        Route::post('/store', [VariantController::class, 'store'])->name('store');
        Route::get('/{id}/show', [VariantController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [VariantController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [VariantController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [VariantController::class, 'destroy'])->name('destroy');
    });

    // Route cho Orders
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
    Route::patch('orders/{order}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

     Route::get('reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::delete('reviews/{id}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Hiển thị danh sách laptop cho người dùng
Route::get('/laptops', [LaptopController::class, 'index'])->name('laptops.index');


// Search
Route::get('laptops-search', [LaptopController::class, 'search'])->name('laptops.search');

// Giỏ hàng
Route::prefix('cart')->name('cart.')->group(function () {
    Route::post('/add', [CartController::class, 'addToCart'])->name('add');
    Route::get('/', [CartController::class, 'viewCart'])->name('view');
    Route::patch('/{id}/update', [CartController::class, 'updateQuantity'])->name('update');
    Route::delete('/{id}/remove', [CartController::class, 'remove'])->name('remove');
});

// Payment
Route::prefix('checkout')->middleware('auth')->name('checkout.')->group(function () {
    Route::get('/', [CartController::class, 'checkoutForm'])->name('form');
    Route::post('/place-order', [CartController::class, 'placeOrder'])->name('place');
});



// Auth
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

Route::get('/order/quick', [CartController::class, 'quickOrderForm'])->middleware('auth')->name('order.quick.form');
Route::post('/order/quick', [CartController::class, 'placeQuickOrder'])->middleware('auth')->name('order.quick.place');
Route::middleware('auth')->get('/order-history', [\App\Http\Controllers\OrderController::class, 'history'])->name('order.history');


