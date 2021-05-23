<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Customize\Mails;

use Illuminate\Notifications\Messages\MailMessage;
use BADDIServices\SocialRocket\Http\Controllers\DashboardController;
use BADDIServices\SocialRocket\Http\Requests\Customize\PurchaseMailPreviewRequest;

class PurchaseMailController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function __invoke(PurchaseMailPreviewRequest $request)
    {
        $template = 'dashboard.customize.mails.purchase.index';

        if (!is_null($request->query('template'))) {
            $template = 'dashboard.customize.mails.purchase.' . $request->query('template');
        }
        
        return (new MailMessage)
                    ->view($template, ['store' => $this->store])
                    ->render();
    }
}