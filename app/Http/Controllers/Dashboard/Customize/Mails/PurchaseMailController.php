<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Dashboard\Customize\Mails;

use Illuminate\Notifications\Messages\MailMessage;
use BADDIServices\ClnkGO\Http\Controllers\DashboardController;
use BADDIServices\ClnkGO\Http\Requests\Customize\PurchaseMailPreviewRequest;

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
                    ->view(
                        $template, 
                        [
                            'store'     => $this->store,
                            'setting'   => $this->setting
                        ]
                    )
                    ->render();
    }
}