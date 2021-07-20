<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Notifications\Subscription;

use BADDIServices\ClnkGO\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SubscriptionCancelled extends Notification
{
    use Queueable;

    /** @var Subscription */
    private $subscription;

    /** @var string */
    public const SUBJECT = 'Your subscription to %s plan has been cancelled!';

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
            'name'              => $this->subscription->pack->name,
            'cancelled_at'      => $this->subscription->delete_at,
            'link'              =>  [
                'url'           =>  route('subscription.select.pack'),
                'label'         =>  'Choose a plan'
            ]
        ];
    }
}