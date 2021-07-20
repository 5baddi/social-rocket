<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Listeners\Subscription;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use BADDIServices\ClnkGO\Models\Subscription;
use BADDIServices\ClnkGO\Events\Subscription\SubscriptionCancelled;

class SubscriptionCancelledFired implements ShouldQueue
{
    /** @var string */
    public const SUBJECT = "Your subscription to %s plan has been cancelled!";

    public function handle(SubscriptionCancelled $event)
    {
        /** @var User */
        $user = $event->user;

        /** @var Subscription */
        $subscription = $event->subscription;

        $subject = sprintf(self::SUBJECT, ucwords($subscription->pack->name));

        Mail::send('emails.subscription.cancelled', ['user' => $user, 'subscription' => $subscription], function($message) use ($user, $subject) {
            $message->to($user->email);
            $message->subject($subject);
        });
    }
}