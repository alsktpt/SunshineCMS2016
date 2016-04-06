<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SauthServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('SAuth', function(){
            return new \App\Services\SunshineAuth();
        });
    }
}
