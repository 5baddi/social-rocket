<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Common\Services\Subscription\PackService;
use Illuminate\Http\Request;
use Illuminate\Session\SessionManager;

class ConnectController extends Controller
{
    public function __construct(
        private PackService $packService,
        private SessionManager $sessionManager 
    ) {
        parent::__construct();
    }

    public function __invoke(Request $request)
    {
        $packId = $request->query('plan');
        if ($packId !== null) {
            $pack = $this->packService->findByKey((int)$packId);
            $this->sessionManager->put('packId', $pack->getId());
        }
        
        return $this->renderView('auth.connect');
    }
}
