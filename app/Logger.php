<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket;

use App\Models\User;
use BADDIServices\SocialRocket\Models\Store;
use Bugsnag\Client;
use Illuminate\Support\Facades\Auth;

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
}