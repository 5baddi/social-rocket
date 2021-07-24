<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket;

use Throwable;
use Bugsnag\Client;
use Bugsnag\Configuration;
use Bugsnag\Breadcrumbs\Breadcrumb;
use Illuminate\Support\Facades\Log;
use BADDIServices\SocialRocket\Models\Store;

class AppLogger
{
    /** @var Store|null */
    private static $store = null;

    /** @var AppLogger */
    private static $instance = null;

    /** @var Client */
    private static $client = null;

    private function __construct() { }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self;

            self::$client = new Client(
                new Configuration(env('BUGSNAG_API_KEY'))
            );

            self::$client->setAppVersion(config('rocket.version'));
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

        self::$client->notifyException($exception);
    }
    
    public static function info(string $message, string $context, array $extra = [])
    {
        $infoContext = [
            'context'   =>  $context,
            'store'     =>  optional(self::$store)->id,
            'extra'     =>  json_encode($extra)
        ];

        Log::info($message, $infoContext);

        self::$client->leaveBreadcrumb(
            $message,
            Breadcrumb::LOG_TYPE,
            $infoContext
        );
    }
}