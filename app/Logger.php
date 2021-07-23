<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO;

use Throwable;
use Bugsnag\Client;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use BADDIServices\ClnkGO\Models\Store;
use Bugsnag\Breadcrumbs\Breadcrumb;
use Bugsnag\BugsnagLaravel\Facades\Bugsnag;

class Logger
{
    /** @var \Bugsnag\Client */
    private $client;

    /** @var Store|null */
    public $store = null;
    
    /** @var User|null */
    public $user = null;

    public function __construct(Client $client) 
    { 
        $this->client = $client;

        $this->client->setAppVersion(config('app.version'));
    }

    public function setStore(?Store $store = null): self
    {
        $this->$store = $store;

        return $this;
    }
    
    public function setUser(?User $user = null): self
    {
        $this->$user = $user;

        if ($user === null && Auth::check()) {
            $this->user = Auth::user();
        }

        return $this;
    }

    public function error(Throwable $exception, string $context, array $extra = []): self
    {
        Log::error($exception->getMessage(), [
            'context'   =>  $context,
            'store'     =>  optional($this->store)->id,
            'code'      =>  $exception->getCode(),
            'line'      =>  $exception->getLine(),
            'file'      =>  $exception->getFile(),
            'trace'     =>  $exception->getTraceAsString(),
            'extra'     =>  json_encode($extra)
        ]);

        $this->client->notifyException($exception);

        return $this;
    }

    public function info(string $message, string $context, array $extra = []): self
    {
        $infoContext = [
            'message'   =>  $message,
            'context'   =>  $context,
            'store'     =>  optional($this->store)->id,
            'user'      =>  optional($this->user)->id,
            'extra'     =>  json_encode($extra)
        ];

        Log::info($message, $infoContext);

        $this->client->leaveBreadcrumb(
            $message,
            Breadcrumb::LOG_TYPE,
            $infoContext
        );

        return $this;
    }
}