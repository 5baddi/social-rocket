<?php

namespace App\Providers;

// use Illuminate\Auth\Events\Registered;
use BADDIServices\ClnkGO\Events\WelcomeMail;
use BADDIServices\ClnkGO\Events\Auth\ResetPassword;
use BADDIServices\ClnkGO\Listeners\WelcomeMailFired;
use BADDIServices\ClnkGO\Listeners\Auth\ResetPasswordFired;
// use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use BADDIServices\ClnkGO\Events\Affiliate\NewOrderCommission;
use BADDIServices\ClnkGO\Events\Subscription\SubscriptionActivated;
use BADDIServices\ClnkGO\Events\Subscription\SubscriptionCancelled;
use BADDIServices\ClnkGO\Listeners\Affiliate\NewOrderCommissionFired;
use BADDIServices\ClnkGO\Listeners\Subscription\SubscriptionActivatedFired;
use BADDIServices\ClnkGO\Listeners\Subscription\SubscriptionCancelledFired;
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
