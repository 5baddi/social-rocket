<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Affiliate;

use Throwable;
use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Http\Requests\Affiliate\NewOrderRequest;
use BADDIServices\SocialRocket\Services\MailListService;
use Symfony\Component\HttpFoundation\Response;

class NewOrderController extends Controller
{
    /** @var MailListService */
    private $mailListService;

    public function __construct(MailListService $mailListService)
    {
        $this->mailListService = $mailListService;
    }

    public function __invoke(NewOrderRequest $request)
    {
        try {
            dd($request->all());
        } catch (Throwable $ex) {
            return response()->json('Internal server error', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}