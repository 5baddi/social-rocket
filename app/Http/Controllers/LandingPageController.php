<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers;

use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Common\Services\Subscription\PackService;

class LandingPageController extends Controller
{
    /** @var PackService */
    private $packService;

    public function __construct(PackService $packService)
    {
        parent::__construct();

        $this->packService = $packService;
    }

    public function __invoke()
    {
        return $this->renderView(
            'landing.home',
            [
                'packs' =>  $this->packService->all()
            ]
        );
    }

    public function privacy()
    {
        return $this->renderView('landing.privacy');
    }
}
