<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Services;

use App\Models\User;
use BADDIServices\ClnkGO\Models\Store;
use BADDIServices\ClnkGO\Models\Setting;
use BADDIServices\ClnkGO\Services\CouponService;
use BADDIServices\ClnkGO\Repositories\AffiliateRepository;
use BADDIServices\ClnkGO\Notifications\Affiliate\NewAffiliateAccount;
use Illuminate\Support\Arr;

class AffiliateService extends Service
{
    /** @var AffiliateRepository */
    private $affiliateRepository;

    /** @var CouponService */
    private $couponService;

    public function __construct(AffiliateRepository $affiliateRepository, CouponService $couponService)
    {
        $this->affiliateRepository = $affiliateRepository;
        $this->couponService = $couponService;
    }

    public function coupons(Store $store): array
    {
        return $this->affiliateRepository->coupons($store->id);
    }
    
    public function exists(int $id): ?User
    {
        return $this->affiliateRepository->exists($id);
    }
    
    public function existsByEmail(string $email): ?User
    {
        return $this->affiliateRepository->existsByEmail($email);
    }
    
    public function create(Store $store, array $attributes): User
    {
        Arr::set($attributes, User::CUSTOMER_ID_COLUMN, $attributes['id']);

        $attributes = collect($attributes);
        $attributes = $attributes->only([
            User::CUSTOMER_ID_COLUMN,
            User::EMAIL_COLUMN,
            User::FIRST_NAME_COLUMN,
            User::LAST_NAME_COLUMN,
        ]);
        $attributes = $attributes->toArray();

        $attributes[User::MAIN_STORE_ID_COLUMN] = $store->id;

        $coupon = $this->couponService->generateDiscountCode($store, $attributes[User::FIRST_NAME_COLUMN]);

        $attributes[User::COUPON_COLUMN] = $coupon;

        return $this->affiliateRepository->create($attributes);
    }
    
    public function notifyStoreOwner(Store $store, User $affiliate): void
    {
        $store->load(['user', 'setting']);
        
        /** @var User */
        $user = $store->user;

        /** @var Setting */
        $setting = $store->setting;

        $user->notify(new NewAffiliateAccount($user, $affiliate, $setting));
    }
}