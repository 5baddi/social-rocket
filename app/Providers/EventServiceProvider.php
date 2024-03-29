<?php

namespace App\Providers;

// use Illuminate\Auth\Events\Registered;
use BADDIServices\SocialRocket\Events\WelcomeMail;
use BADDIServices\SocialRocket\Events\Auth\ResetPassword;
use BADDIServices\SocialRocket\Listeners\WelcomeMailFired;
use BADDIServices\SocialRocket\Listeners\Auth\ResetPasswordFired;
// use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use BADDIServices\SocialRocket\Events\Affiliate\NewOrderCommission;
use BADDIServices\SocialRocket\Events\Subscription\SubscriptionActivated;
use BADDIServices\SocialRocket\Events\Subscription\SubscriptionCancelled;
use BADDIServices\SocialRocket\Listeners\Affiliate\NewOrderCommissionFired;
use BADDIServices\SocialRocket\Listeners\Subscription\SubscriptionActivatedFired;
use BADDIServices\SocialRocket\Listeners\Subscription\SubscriptionCancelledFired;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /** @var array */
    protected $listen = [
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],

        WelcomeMail::class => [
            WelcomeMailFired::class,
        ],

        ResetPassword::class => [
            ResetPasswordFired::class,
        ],

        SubscriptionActivated::class => [
            SubscriptionActivatedFired::class,
        ],
        
        SubscriptionCancelled::class => [
            SubscriptionCancelledFired::class,
        ],

        NewOrderCommission::class => [
            NewOrderCommissionFired::class,
        ]
    ];

    public function boot()
    {
        
    }
}
