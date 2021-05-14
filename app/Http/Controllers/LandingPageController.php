<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers;

use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Services\AppService;

class LandingPageController extends Controller
{
    /** @var AppService */
    private $appService;

    public function __construct(AppService $appService)
    {
        $this->appService = $appService;
    }

    public function __invoke()
    {
        return view('landing', [
            'appSettings'   =>  $this->appService->settings()
        ]);
    }
}
