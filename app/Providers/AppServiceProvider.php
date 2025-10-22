<?php

namespace App\Providers;

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
        // Register route middleware alias for role checks.
        if ($this->app->resolved('router')) {
            $this->app->make('router')->aliasMiddleware('role', \App\Http\Middleware\CheckRole::class);
        } else {
            $this->app->booting(function () {
                $this->app->make('router')->aliasMiddleware('role', \App\Http\Middleware\CheckRole::class);
            });
        }
    }
}
