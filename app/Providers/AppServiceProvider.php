<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\LaptopRepositoryInterface;
use App\Repositories\EloquentLaptopRepository;
use App\Interfaces\CategoryRepositoryInterface;
use App\Repositories\EloquentCategoryRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LaptopRepositoryInterface::class, EloquentLaptopRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, EloquentCategoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
          View::composer('*', function ($view) {
        $view->with('categories', Category::all());
    });
    }
}
