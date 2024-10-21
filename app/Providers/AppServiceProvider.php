<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Support\FeatureFlag\Manager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(
            Manager::class,
            fn($app) => new Manager($app['config']->get('features'), database_path("migrations/features"))
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom($this->app[Manager::class]->getFeatureMigrationPaths());
    }
}
