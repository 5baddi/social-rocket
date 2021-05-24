<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use BADDIServices\SocialRocket\Events\Auth\ResetPassword;

class ResetPasswordFired
{
    /** @var string */
    public const SUBJECT = "Reset link ";

    public function handle(ResetPassword $event)
    {
        /** @var User */
        $user = $event->user;

        Mail::send('emails.auth.reset', ['user' => $user, 'subject' => self::SUBJECT . config('app.name')], function($message) use ($user) {
            $message->to($user->email);
            $message->subject(self::SUBJECT . config('app.name'));
        });
    }
}