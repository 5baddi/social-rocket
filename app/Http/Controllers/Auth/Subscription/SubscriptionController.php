<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Auth\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BADDIServices\SocialRocket\Services\PackService;

class SubscriptionController extends Controller
{
    /** @var PackService */
    private $packService;

    public function __construct(PackService $packService)
    {
        $this->packService = $packService;
    }

    public function __invoke()
    {
        return view('auth.subscription.index', [
            'packs'         =>  $this->packService->all(),
            'currentPack'   =>  $this->packService->loadCurrentPack(Auth::user())
        ]);
    }
}