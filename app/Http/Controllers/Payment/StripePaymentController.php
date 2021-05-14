<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Payment;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Stripe\Exception\ApiErrorException;
use BADDIServices\SocialRocket\Models\Pack;
use Symfony\Component\HttpFoundation\Response;
use BADDIServices\SocialRocket\Services\PackService;
use BADDIServices\SocialRocket\Services\StripeService;
use BADDIServices\SocialRocket\Http\Requests\PaymentRequest;

class StripePaymentController extends Controller
{
    /** @var PackService */
    private $packService;
    
    /** @var StripeService */
    private $stripeService;

    public function __construct(PackService $packService, StripeService $stripeService)
    {
        $this->packService = $packService;
        $this->stripeService = $stripeService;
    }

    public function __invoke(string $packId, PaymentRequest $request)
    {
        try {
            $pack = $this->packService->findById($packId);
            abort_unless($pack instanceof Pack, Response::HTTP_UNPROCESSABLE_ENTITY, 'Unprocessable pack');

            $paymentIntent = $this->stripeService->createPaymentIntent($pack);
        } catch (ApiErrorException $ex) {
            Log::error($ex->getMessage(), [
                'context'   =>  'payment:stripe:failed',
                'code'      =>  $ex->getCode(),
                'line'      =>  $ex->getLine(),
                'file'      =>  $ex->getFile(),
                'trace'     =>  $ex->getTrace()
            ]);

            return redirect()->route('subscription.pay')->withInput()->with('error', 'Payment creation failed!');
        }
    }
}