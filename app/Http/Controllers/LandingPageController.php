<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers;

use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Services\AppService;
use BADDIServices\SocialRocket\Services\PackService;

class LandingPageController extends Controller
{
    /** @var AppService */
    private $appService;

    /** @var PackService */
    private $packService;

    public function __construct(AppService $appService, PackService $packService)
    {
        $this->appService = $appService;
        $this->packService = $packService;
    }

    public function __invoke()
    {
        return view('landing', [
            'appSettings'   =>  $this->appService->settings(),
            'packs'         =>  $this->packService->all()
        ]);
    }

    public function privacy()
    {
        return view('privacy', [
            'appSettings'   =>  $this->appService->settings(),
        ]);
    }
}