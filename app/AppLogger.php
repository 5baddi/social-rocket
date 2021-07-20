<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO;

use Throwable;
use Illuminate\Support\Facades\Log;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
use BADDIServices\ClnkGO\Models\Store;

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

        Bugsnag::setAppVersion(config('app.version'));

        return self::$instance;
    }


    public static function setStore(?Store $store = null): self
    {
        self::$store = $store;

        return self::getInstance();
    }

    public static function error(Throwable $exception, string $context, array $extra = []): self
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

        Bugsnag::notifyException($exception);

        return self::getInstance();
    }
    
    public static function info(string $message, string $context, array $extra = []): self
    {
        Log::info($message, [
            'context'   =>  $context,
            'store'     =>  optional(self::$store)->id,
            'extra'     =>  json_encode($extra)
        ]);

        return self::getInstance();
    }
}