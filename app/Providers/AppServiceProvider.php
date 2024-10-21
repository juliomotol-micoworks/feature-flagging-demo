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
        foreach($this->app['config']->get('features') as $feature => $state) {
            if ($state) {
                $this->loadMigrationsFrom(database_path("migrations/features/{$feature}"));
            }
        }
    }
}
