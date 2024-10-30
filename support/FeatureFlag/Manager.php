<?php

namespace Support\FeatureFlag;

use Illuminate\Support\Str;

class Manager
{
    public function __construct(
        protected array $features,
        protected string $migrationPathPrefix
    ) {}

    public function active(string $feature): mixed
    {
        return $this->normalizeFeatureValue($this->features[$feature]);
    }

    public function inactive(string $feature): mixed
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
