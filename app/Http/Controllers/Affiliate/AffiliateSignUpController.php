<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Services\MailListService;
use BADDIServices\SocialRocket\Http\Requests\AffiliateSignInRequest;
use BADDIServices\SocialRocket\Models\MailList;
use Throwable;

class AffiliateSignUpController extends Controller
{
    /** @var MailListService */
    private $mailListService;

    public function __construct(MailListService $mailListService)
    {
        $this->mailListService = $mailListService;
    }

    public function __invoke(Store $store, AffiliateSignInRequest $request)
    {
        try {
            $exists = $this->mailListService->exists($request->input(MailList::EMAIL_COLUMN));
            if ($exists) {
                return redirect()->back()->withInput()->with('error', 'Email already registered!');
            }

            $mailList = $this->mailListService->create($store, $request->input());

            $this->mailListService->welcomeMail($mailList);

            $this->mailListService->notifyStoreOwner($store, $mailList);

            return redirect()->back()->with('success', 'Thank you for your inscription! please check your mailbox');
        } catch (Throwable $ex) {
            dd($ex);
            return redirect()->back()->withInput()->with('error', 'Something going wrong during inscription');
        }
    }
}