<?php

namespace Support\FeatureFlag;

use Illuminate\Support\Facades\Facade;

class FeatureFlag extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Manager::class;
    }
}
