<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Events\Payouts;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use BADDIServices\ClnkGO\Models\Store;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;

class PaymentWasSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;

    /** @var Store */
    public $store;
    
    /** @var User */
    public $user;

    public function __construct(Store $store, User $user)
    {
        $this->store = $store;
        $this->user = $user;
    }

    /**
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}