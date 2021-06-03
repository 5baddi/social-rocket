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
    /** @var Store|null */
    private static $store = null;

    public static function setStore(?Store $store = null): self
    {
        static::$store = $store;

        return static;
    }

    public static function error(Throwable $exception, string $context, array $extra = [])
    {
        Log::error($exception->getMessage(), [
            'context'   =>  $context,
            'store'     =>  optional(static::$store)->id,
            'code'      =>  $exception->getCode(),
            'line'      =>  $exception->getLine(),
            'file'      =>  $exception->getFile(),
            'trace'     =>  $exception->getTraceAsString(),
            'extra'     =>  json_encode($extra)
        ]);
    }
    
    public static function info(string $message, string $context, array $extra = [])
    {
        Log::info($message, [
            'context'   =>  $context,
            'store'     =>  optional(static::$store)->id,
            'extra'     =>  json_encode($extra)
        ]);
    }
}