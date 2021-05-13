<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use BADDIServices\SocialRocket\Events\WelcomeMail;

class WelcomeMailFired
{
    public function handle(WelcomeMail $event)
    {
        /** @var User */
        $user = $event->user;

        Mail::send('emails.welcome', compact($user), function($message) use ($user) {
            $message->to($user->email);
            $message->subject("Welcome to " . config('app.name'));
        });
    }
}
