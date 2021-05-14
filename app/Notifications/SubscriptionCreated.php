<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Notifications;

use BADDIServices\SocialRocket\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionCreated extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var Subscription */
    private $subscription;

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
        // return ['mail', 'database'];
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'subscription_id'   => $this->subscription->id, 
            'pack_id'           => $this->subscription->pack_id, 
            'type'              => $this->subscription->pack->price_type,
            'price'             => $this->subscription->pack->price,
            'name'              => $this->subscription->pack->name,
            'cycle'             => $this->subscription->pack->payment_cycle,
            'currency_symbol'   => $this->subscription->pack->currency_symbol,
            'is_paid'           => !is_null($this->subscription->paid_at),
        ];
    }
}