<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket;

use Throwable;
use Bugsnag\Client;
use App\Models\User;
use Psr\Log\LoggerInterface;
use Bugsnag\Breadcrumbs\Breadcrumb;
use Illuminate\Support\Facades\Log;
use BADDIServices\SocialRocket\Models\Store;

class Logger implements LoggerInterface
{
    /** @var Client */
    private $client = null;

    /** @var User|null */
    public $user = null;
    
    /** @var Store|null */
    public $store = null;

    public function __construct(Client $client) 
    { 
        $this->client = $client;
        $this->client->setAppVersion(config('baddi.version'));
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function setStore(?Store $store = null): self
    {
        $this->store = $store;

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
            'store'     => optional($this->store)->getId(),
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
        $this->trace($message, $context);
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