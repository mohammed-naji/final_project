<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewView;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrapFour();
        View::share('global_categories', Category::with('children')->whereNull('parent_id')->limit(4)->get());
        View::share('name', 'name_' . app()->currentLocale());
        View::share('content', 'content_' . app()->currentLocale());
        // View::share('user_cart', Auth::user()->carts);
    }
}
