<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Listeners\Affiliate;

use App\Models\User;
use BADDIServices\ClnkGO\Events\Affiliate\NewOrderCommission;
use Illuminate\Support\Facades\Mail;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Models\Commission;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOrderCommissionFired implements ShouldQueue
{
    /** @var string */
    public const SUBJECT = "Affiliate awaiting commission $";

    public function handle(NewOrderCommission $event)
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