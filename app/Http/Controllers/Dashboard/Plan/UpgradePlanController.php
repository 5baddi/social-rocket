<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Plan;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BADDIServices\SocialRocket\Services\PackService;

class UpgradePlanController extends Controller
{
    /** @var PackService */
    private $packService;

    public function __construct(PackService $packService)
    {
        $this->packService = $packService;
    }

    public function __invoke()
    {
        return view('dashboard.plan.upgrade', [
            'title'                 =>  'Upgrade your plan',
            'packs'                 =>  $this->packService->all(),
            'currentPack'           =>  $this->packService->loadCurrentPack(Auth::user())
        ]);
    }
}