<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Notifications\Affiliate;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use BADDIServices\SocialRocket\Models\Setting;
use BADDIServices\SocialRocket\Models\MailList;
use Illuminate\Notifications\Messages\MailMessage;

class NewAccount extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var User */
    private $user;
    
    /** @var MailList */
    private $mailList;
    
    /** @var Setting */
    private $setting;

    /** @var string */
    public const SUBJECT = 'New affiliated account has been registered!';

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, MailList $mailList, Setting $setting)
    {
        $this->user = $user;
        $this->mailList = $mailList;
        $this->setting = $setting;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if (!$this->setting->notify_new_account) {
            return ['database'];
        }

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
                    ->view('emails.affiliate.new', ['subject' => self::SUBJECT, 'user' => $this->user, 'mailList' => $this->mailList]);
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
            // 'link'              =>  [
            //     'url'           =>  route('dashboard'),
            //     'label'         =>  'Getting started'
            // ]
        ];
    }
}