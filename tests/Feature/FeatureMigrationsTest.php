<?php

use App\Providers\AppServiceProvider;
use Support\FeatureFlag\Manager;

it('can run migrations', function (string $feature, string $migrationName) {
    $this->app['config']->set("features.{$feature}", false);

    unset($this->app[Manager::class]);
    $this->app->register(AppServiceProvider::class, true);

    $this->artisan('migrate:fresh');

    if ($migrationName) {
        expect($this->app['migration.repository']->getRan())
            ->not
            ->toContain($migrationName);
    }

    $this->app['config']->set("features.{$feature}", true);

    unset($this->app[Manager::class]);
    $this->app->register(AppServiceProvider::class, true);

    $this->artisan('migrate');

    if ($migrationName) {
        expect($this->app['migration.repository']->getRan())
            ->toContain($migrationName);
    }
})
    ->with([
        'foo' => ['foo', '2024_10_21_131020_create_foo_table'],
        'bar' => ['bar', '2024_10_21_131104_create_bar_table'],
        // baz doesn't have any migrations to run so no need to assert
    ]);
