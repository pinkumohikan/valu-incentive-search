<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // @see https://laravel-news.com/laravel-5-4-key-too-long-error
        Schema::defaultStringLength(191);

        \View::composer('layout', function () {
            \View::share('registeredIncentiveCount', 999);  // FIXME
            \View::share('suggestedKeywords', ['拡散', '似顔絵', 'プレゼント', '投資']);
        });

        \View::composer('index', function () {
            \View::share('pickupIncentives', []); // FIXME
            \View::share('newlyIncentives', []); // FIXME
            \View::share('popularIncentives', []); // FIXME
            \View::share('endNearlyIncentives', []); // FIXME
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
