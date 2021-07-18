<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;

class WelcomeMail
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;

    /** @var Store */
    public $store;
    
    /** @var User */
    public $user;

    /** @var bool */
    public $isAffiliate = false;

    public function __construct(Store $store, User $user, bool $isAffiliate = false)
    {
        $this->store = $store;
        $this->user = $user;
        $this->isAffiliate = $isAffiliate;
    }

    /**
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
