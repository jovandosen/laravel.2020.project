<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('bar', function($app){
            return new \App\Services\Bar();
        });

        $this->app->bind('test', function($app){
            return new \App\Services\Test();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $bar = $this->app->make('bar');
        $test = $this->app->make('test');
    }
}
