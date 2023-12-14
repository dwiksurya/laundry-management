<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        // set app location to indonesia
        config(['app.locale' => 'id']);
        \Carbon\Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        Paginator::useBootstrap();
    }
}
