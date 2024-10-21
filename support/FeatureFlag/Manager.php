<?php

namespace Support\FeatureFlag;

use Illuminate\Support\Str;

class Manager
{
    public function __construct(
        protected array $features,
        protected string $migrationPathPrefix
    ) {}

    public function active(string $feature): bool
    {
        return (bool) $this->features[$feature];
    }

    public function inactive(string $feature): bool
    {
        return !$this->active($feature);
    }

    public function getFeatureMigrationPaths(): array
    {
        $paths = [];

        foreach ($this->features as $feature => $state) {
            if ($state) {
                $paths[] = Str::finish($this->migrationPathPrefix, '/').$feature;
            }
        }

        return $paths;
    }
}
