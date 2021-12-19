<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Listeners\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use BADDIServices\SocialRocket\Events\Auth\ResetPassword;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPasswordFired implements ShouldQueue
{
    /** @var string */
    public const SUBJECT = "Reset your %s password";

    public function handle(ResetPassword $event)
    {
        /** @var User */
        $user = $event->user;

        /** @var string */
        $token = $event->token;

        $subject = sprintf(self::SUBJECT, config('app.name'));

        Mail::send('emails.auth.reset', ['user' => $user, 'token' => $token, 'subject' => $subject], function($message) use ($user, $subject) {
            $message->to($user->email);
            $message->subject($subject);
        });
    }
}