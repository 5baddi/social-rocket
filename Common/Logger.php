<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common;

use BADDIServices\SocialRocket\Common\Entities\Shop\Shop;
use Bugsnag\Configuration;
use Throwable;
use Bugsnag\Client;
use App\Models\User;
use Psr\Log\LoggerInterface;
use Bugsnag\Breadcrumbs\Breadcrumb;
use Illuminate\Support\Facades\Log;

class Logger implements LoggerInterface
{
    /** @var Client */
    private $client = null;

    /** @var User|null */
    private $user = null;

    /** @var Shop|null */
    private $shop = null;

    public function __construct()
    {
        $apiKey = config('baddi.bugsnag.api_key');
        $config = new Configuration($apiKey);

        $this->client = new Client($config);
        $this->client->setAppVersion(config('baddi.version'));
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function setShop(?Shop $shop = null): self
    {
        $this->shop = $shop;

        return $this;
    }

    public function trace(
        string $message,
        array $extra = [],
        Throwable $exception = null,
        string $level = Breadcrumb::LOG_TYPE
    ): self
    {
        Log::error($message, [
            'user'      => optional($this->user)->getId(),
            'shop'      => optional($this->shop)->getId(),
            'extra'     => json_encode($extra),
            'trace'     => !is_null($exception) && $exception->getTraceAsString()
        ]);

        if ($exception === null) {
            $this->client->leaveBreadcrumb(
                $message,
                $level,
                $extra
            );
        } else {
            $this->client->notifyException($exception);
        }

        return $this;
    }

    public function emergency($message, array $context = array())
    {
        $this->trace($message, $context);
    }

    public function alert($message, array $context = array())
    {
        $this->trace($message, $context);
    }

    public function critical($message, array $context = array())
    {
        $this->trace($message, $context);
    }

    public function error($message, array $context = array())
    {
        $this->trace($message, $context, null, Breadcrumb::ERROR_TYPE);
    }

    public function warning($message, array $context = array())
    {
        $this->trace($message, $context);
    }

    public function notice($message, array $context = array())
    {
        $this->trace($message, $context);
    }

    public function info($message, array $context = array())
    {
        $this->trace($message, $context);
    }

    public function debug($message, array $context = array())
    {
        $this->trace($message, $context, null, Breadcrumb::STATE_TYPE);
    }

    public function log($level, $message, array $context = array())
    {
        $this->trace($message, $context, null, Breadcrumb::ERROR_TYPE);
    }
}
