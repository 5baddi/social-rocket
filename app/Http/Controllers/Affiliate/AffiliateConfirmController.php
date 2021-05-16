<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Models\MailList;
use BADDIServices\SocialRocket\Services\MailListService;

class AffiliateConfirmController extends Controller
{
    /** @var MailListService */
    private $mailListService;

    public function __construct(MailListService $mailListService)
    {
        $this->mailListService = $mailListService;
    }

    public function __invoke(MailList $mailList)
    {
        return redirect()->route('signin');
    }
}