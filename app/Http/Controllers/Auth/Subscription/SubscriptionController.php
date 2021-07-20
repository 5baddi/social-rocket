<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Auth\Subscription;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use BADDIServices\ClnkGO\Models\Pack;
use BADDIServices\ClnkGO\Services\PackService;

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
        $currentPack = $this->packService->loadCurrentPack(Auth::user());
        if ($currentPack instanceof Pack) {
            return redirect()->route('dashboard.plan.upgrade');
        }

        return view('auth.subscription.index', [
            'packs'         =>  $this->packService->all(),
            'currentPack'   =>  $currentPack
        ]);
    }
}