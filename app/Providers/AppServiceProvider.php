<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Pennant\Feature;

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
        $this->defineFeatures();
    }

    protected function defineFeatures(): void
    {
        foreach($this->app['config']->get('features') as $feature => $state) {
            Feature::define($feature, fn () => $state);
            if ($state) {
                $this->loadMigrationsFrom(database_path("migrations/features/{$feature}"));
            }
        }
    }
}
