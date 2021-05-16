<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Notifications\Subscription;

use BADDIServices\SocialRocket\Models\Subscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionCancelled extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var Subscription */
    private $subscription;

    /** @var string */
    public const SUBJECT = 'Your subscription has been cancelled!';

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
        return ['mail', 'database'];
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
                    ->subject(self::SUBJECT)
                    ->view('emails.subscription.cancelled', ['subject' => self::SUBJECT, 'subscription' => $this->subscription]);
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
            'subject'           => self::SUBJECT,
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