<?php

/**
 * ClnkGO
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

    /** @var AppLogger */
    private static $instance = null;

    private function __construct() { }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }

        return self::$instance;
    }


    public static function setStore(?Store $store = null): self
    {
        self::$store = $store;

        return self::getInstance();
    }

    public static function error(Throwable $exception, string $context, array $extra = [])
    {
        Log::error($exception->getMessage(), [
            'context'   =>  $context,
            'store'     =>  optional(self::$store)->id,
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
            'store'     =>  optional(self::$store)->id,
            'extra'     =>  json_encode($extra)
        ]);
    }
}