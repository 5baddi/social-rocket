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
    /** @var string */
    public const SUBJECT = "Welcome to ";

    public function handle(WelcomeMail $event)
    {
        /** @var User */
        $user = $event->user;

        Mail::send('emails.welcome', ['user' => $user, 'subject' => self::SUBJECT . config('app.name')], function($message) use ($user) {
            $message->to($user->email);
            $message->subject(self::SUBJECT . config('app.name'));
        });
    }
}
