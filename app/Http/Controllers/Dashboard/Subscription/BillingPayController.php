<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Subscription;

use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Models\Pack;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Services\PackService;

class BillingPayController extends Controller
{
    /** @var PackService */
    private $packService;

    public function __construct(PackService $packService)
    {
        $this->packService = $packService;
    }

    public function __invoke(string $id)
    {
        $pack = $this->packService->findById($id);
        abort_unless($pack instanceof Pack, Response::HTTP_NOT_FOUND, 'No pack selected');

        return view('dashboard.subscription.pay');
    }
}
