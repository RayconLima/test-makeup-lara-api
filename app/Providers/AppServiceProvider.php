<?php

namespace App\Providers;

use App\Models\{Brand, Category, Type};
use App\Observers\{BrandObserver, CategoryObserver, TypeObserver};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Brand::observe(BrandObserver::class);
        Type::observe(TypeObserver::class);
        Category::observe(CategoryObserver::class);
    }
}
