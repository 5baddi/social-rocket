<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket;

use BADDIServices\SocialRocket\Models\Store;
use Throwable;
use Illuminate\Support\Facades\Log;

class AppLogger
{
    public static function error(Throwable $exception, ?Store $store, string $context, array $extra = [])
    {
        Log::error($exception->getMessage(), [
            'context'   =>  $context,
            'store'     =>  optional($store)->id,
            'code'      =>  $exception->getCode(),
            'line'      =>  $exception->getLine(),
            'file'      =>  $exception->getFile(),
            'trace'     =>  $exception->getTraceAsString(),
            'extra'     =>  json_encode($extra)
        ]);
    }
}