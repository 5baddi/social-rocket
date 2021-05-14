<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Dashboard\Subscription;

use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Http\Requests\PaymentRequest;

class StripePaymentController extends Controller
{
    public function __invoke(string $packId, PaymentRequest $request)
    {
        
    }
}