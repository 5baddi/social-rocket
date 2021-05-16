<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers;

use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Services\CouponService;

class OrderStatusScriptController extends Controller
{
    /** @var CouponService */
    private $couponService;

    public function __construct(CouponService $couponService)
    {
        $this->couponService = $couponService;
    }
    
    public function __invoke()
    {
        return view('script', [
            'html'      =>  $this->couponService->getScriptTag()
        ]);
    }
}