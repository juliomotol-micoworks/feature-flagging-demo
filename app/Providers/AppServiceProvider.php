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
            Feature::define($feature, fn () => $this->normalizeFeatureValue($state));
            if ($state) {
                $this->loadMigrationsFrom(database_path("migrations/features/{$feature}"));
            }
        }
    }

    protected function normalizeFeatureValue(mixed $value): mixed
    {
        if (str_contains($value, ',')) {
            return explode(',', $value);
        }

        if (is_numeric($value)) {
            return (int) $value;
        }

        if (!filter_var($value, FILTER_VALIDATE_BOOLEAN)) {
            return $value;
        }

        return filter_var($value, FILTER_VALIDATE_BOOLEAN);
    }
}
