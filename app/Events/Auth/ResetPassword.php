<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Events\Auth;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Bus\Queueable;

class ResetPassword
{
    use Dispatchable, InteractsWithSockets, SerializesModels, Queueable;
    
    /** @var User */
    public $user;

    /** @var string */
    public $token;

    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}