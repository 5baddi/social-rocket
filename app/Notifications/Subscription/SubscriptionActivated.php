<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Notifications\Subscription;

use BADDIServices\SocialRocket\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionActivated extends Notification
{
    use Queueable;

    /** @var Subscription */
    private $subscription;

    /** @var string */
    public const SUBJECT = 'Your subscription to %s plan has been activated!';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Subscription $subscription)
    {
        $this->subscription = $subscription;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'subject'           => sprintf(self::SUBJECT, ucwords($this->subscription->pack->name)),
            'subscription_id'   => $this->subscription->id,
            'pack_id'           => $this->subscription->pack_id,
            'type'              => $this->subscription->pack->price_type,
            'price'             => $this->subscription->pack->price,
            'name'              => $this->subscription->pack->name,
            'cycle'             => $this->subscription->pack->payment_cycle,
            'currency_symbol'   => $this->subscription->pack->currency_symbol,
            'is_paid'           => !is_null($this->subscription->paid_at),
            'link'              =>  [
                'url'           =>  route('dashboard.customize.integrations'),
                'label'         =>  'Getting started'
            ]
        ];
    }
}
