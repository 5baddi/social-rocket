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
use BADDIServices\SocialRocket\Models\Commission;
use BADDIServices\SocialRocket\Events\WelcomeMail;

class NewOrderCommissionFired
{
    /** @var string */
    public const SUBJECT = "Affiliate awaiting commission $";

    public function handle(WelcomeMail $event)
    {
        /** @var User */
        $affiliate = $event->affiliate;
        
        /** @var Store */
        $store = $event->store;
        
        /** @var Commission */
        $commission = $event->commission;

        Mail::send('emails.affiliate.commission', ['affiliate' => $affiliate, 'commission' => $commission, 'store' => $store, 'subject' => self::SUBJECT . config('app.name')], function($message) use ($affiliate, $commission) {
            $message->to($affiliate->email);
            $message->subject(self::SUBJECT . number_format($commission->amount, 2));
        });
    }
}