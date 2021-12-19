<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Events\WelcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMailFired implements ShouldQueue
{
    /** @var string */
    public const SUBJECT = "Welcome to ";

    public function handle(WelcomeMail $event)
    {
        /** @var Store */
        $store = $event->store;

        /** @var User */
        $user = $event->user;

        /** @var bool */
        $isAffiliate = $event->isAffiliate ?? false;

        $template = 'emails.welcome';
        if ($isAffiliate) {
            $template = 'emails.affiliate.welcome';
        }

        Mail::send($template, ['store' => $store, 'user' => $user, 'subject' => self::SUBJECT . config('app.name')], function($message) use ($user) {
            $message->to($user->email);
            $message->subject(self::SUBJECT . config('app.name'));
        });
    }
}
