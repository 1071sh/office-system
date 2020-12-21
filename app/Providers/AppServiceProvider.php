<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;  // Heroku用
use Illuminate\Routing\UrlGenerator;    // Heroku用

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
    public function boot(UrlGenerator $url)
    {
        if (env('APP_ENV') === 'production') { // HTTPS用
            $url->forceScheme('https');
        }
        Schema::defaultStringLength(191); // Heroku用
    }
}
