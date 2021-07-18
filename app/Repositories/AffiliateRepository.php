<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class AffiliateRepository
{
    public function all(): Collection
    {
        return User::query()
                    ->all();
    }
    
    public function create(array $attributes): User
    {
        return User::query()
                    ->create($attributes);
    }
    
    public function exists(int $id): ?User
    {
        return User::query()
                    ->where(User::CUSTOMER_ID_COLUMN, $id)
                    ->first();
    }
    
    public function existsByEmail(string $email): ?User
    {
        return User::query()
                    ->where(User::EMAIL_COLUMN, $email)
                    ->first();
    }

    public function coupons(string $storeId): array
    {
        return User::query()
                    ->where(User::STORE_ID_COLUMN, $storeId)
                    ->get()
                    ->pluck(User::COUPON_COLUMN)
                    ->toArray();
    }
}