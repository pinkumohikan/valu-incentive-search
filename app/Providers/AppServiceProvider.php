<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Peanut\ValuIncentive\Finder;

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
            $finder = resolve(Finder::class);
            assert($finder instanceof Finder);
            \View::share('registeredIncentiveCount', $finder->countIncentives());
            \View::share('suggestedKeywords', ['拡散', '似顔絵', 'プレゼント', '投資']);
        });

        \View::composer('index', function () {
            $finder = resolve(Finder::class);
            assert($finder instanceof Finder);
            \View::share('newlyIncentives', $finder->findNewly());
            \View::share('popularIncentives', $finder->findPopular());
            \View::share('endNearlyIncentives', $finder->findPeriodEndNearly());
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
