<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use App\Models\User;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Setting;
use BADDIServices\SocialRocket\Models\MailList;
use BADDIServices\SocialRocket\Services\CouponService;
use BADDIServices\SocialRocket\Repositories\MailListRepository;
use BADDIServices\SocialRocket\Notifications\Affiliate\NewAffiliateAccount;

class MailListService extends Service
{
    /** @var MailListRepository */
    private $mailListRepository;

    /** @var CouponService */
    private $couponService;

    public function __construct(MailListRepository $mailListRepository, CouponService $couponService)
    {
        $this->mailListRepository = $mailListRepository;
        $this->couponService = $couponService;
    }

    public function exists(string $email): bool
    {
        return $this->mailListRepository->exists($email);
    }
    
    public function create(Store $store, array $attributes): MailList
    {
        $attributes[MailList::STORE_ID_COLUMN] = $store->id;

        $coupon = $this->couponService->generateDiscountCode($store, $attributes[MailList::FIRST_NAME_COLUMN]);

        $attributes[MailList::COUPON_COLUMN] = $coupon;

        return $this->mailListRepository->create($attributes);
    }
    
    public function welcomeMail(MailList $mailList): void
    {
        
    }
    
    public function notifyStoreOwner(Store $store, MailList $mailList): void
    {
        $store->load(['user', 'setting']);
        
        /** @var User */
        $user = $store->user;

        /** @var Setting */
        $setting = $store->setting;

        $user->notify(new NewAffiliateAccount($user, $mailList, $setting));
    }
}