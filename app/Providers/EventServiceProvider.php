<?php

namespace App\Providers;

use BADDIServices\SocialRocket\Events\WelcomeMail;
use BADDIServices\SocialRocket\Listeners\WelcomeMailFired;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /** @var array */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        WelcomeMail::class => [
            WelcomeMailFired::class,
        ]
    ];

    public function boot()
    {
        
    }
}
