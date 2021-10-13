<?php

/**
 * Social Rocket
 *
 * @package Shopify
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Packages\Shopify\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($model){
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::orderedUuid()->toString();
            }
        });
    }
}

