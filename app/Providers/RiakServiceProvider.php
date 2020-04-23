<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Bar;

class RiakServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Bar::class, function ($app) {
            return new Bar();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
