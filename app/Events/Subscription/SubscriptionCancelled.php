<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Events\Subscription;

use App\Models\User;
use BADDIServices\ClnkGO\Models\Subscription;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;

class SubscriptionCancelled
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;
    
    /** @var User */
    public $user;

    /** @var Subscription */
    public $subscription;

    public function __construct(User $user, Subscription $subscription)
    {
        $this->user = $user;
        $this->subscription = $subscription;
    }

    /**
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}