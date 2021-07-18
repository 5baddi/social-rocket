<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Listeners\Affiliate;

use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Setting;
use BADDIServices\SocialRocket\Events\Affiliate\PurchaseReminder;
use BADDIServices\SocialRocket\Events\Affiliate\PurchaseReminder\FirstPurchaseReminder;
use BADDIServices\SocialRocket\Events\Affiliate\PurchaseReminder\ThirdPurchaseReminder;
use BADDIServices\SocialRocket\Events\Affiliate\PurchaseReminder\SecondPurchaseReminder;

class PurchaseReminderFired implements ShouldQueue
{
    /** @var string */
    public const SUBJECT = "Now you get paid cold hard cash for every sale you bring us! 🤑";

    public function handle(PurchaseReminder $event)
    {
        /** @var User */
        $affiliate = $event->affiliate;
        
        /** @var Store */
        $store = $event->store;
        
        /** @var string|null */
        $reminder = $event->reminder;

        /** @var Setting */
        $setting = $event->setting;

        $emailLayout = 'emails.purchase.instantly';

        if ($reminder instanceof FirstPurchaseReminder) {
            $emailLayout = 'emails.purchase.24h';
        }
        
        if ($reminder instanceof SecondPurchaseReminder) {
            $emailLayout = 'emails.purchase.48h';
        }

        if ($reminder instanceof ThirdPurchaseReminder) {
            $emailLayout = 'emails.purchase.120h';
        }

        Mail::send($emailLayout, ['affiliate' => $affiliate, 'store' => $store, 'setting' => $setting], function($message) use ($affiliate) {
            $message->to($affiliate->email);
            $message->subject(self::SUBJECT);
        });
    }
}