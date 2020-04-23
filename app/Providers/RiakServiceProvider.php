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
        $this->app->bind('baz', function ($app) {
            return new \App\Services\Baz();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $baz = $this->app->make('baz');
    }
}
