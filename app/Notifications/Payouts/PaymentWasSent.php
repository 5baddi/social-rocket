<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Notifications\Payouts;

use BADDIServices\SocialRocket\Models\Commission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentWasSent extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var Commission */
    private $commission;

    /** @var string */
    public const SUBJECT = 'Commission payment has been sent!';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Commission $commission)
    {
        $this->commission = $commission;
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
                    ->view('emails.payouts.sent', ['subject' => self::SUBJECT, 'commission' => $this->commission]);
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
            'affiliate'         => $this->affiliate->getFullName(), 
            'commission_id'     => $this->commission->id, 
            'payout_method'     => $this->commission->payout_method, 
            'payout_reference'  => $this->commission->payout_reference, 
            'amount'            => $this->commission->amount, 
            'additional_info'   => $this->commission->additional_info, 
            'paid_at'           => $this->commission->paid_at,
            'link'              =>  [
                'url'           =>  route('dashboard.payouts'),
                'label'         =>  'More details'
            ]
        ];
    }
}