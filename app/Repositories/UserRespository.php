<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRespository
{
    public function paginateWithRelations(?int $page = null): LengthAwarePaginator
    {
        return User::query()
                    ->with(['store'])
                    ->paginate(10, ['*'], 'ap', $page);
    }

    public function exists(int $customerId): ?User
    {
        return User::query()
                    ->with(['store', 'subscription'])
                    ->where(User::CUSTOMER_ID_COLUMN, $customerId)
                    ->first();
    }
    
    public function findByEmail(string $email): ?User
    {
        return User::query()
                    ->with(['store', 'subscription'])
                    ->where([
                        User::EMAIL_COLUMN => strtolower($email)
                    ])
                    ->first();
    }
    
    public function getStoreOwner(string $storeId): ?User
    {
        return User::query()
                    ->where([
                        User::STORE_ID_COLUMN   => $storeId,
                        User::ROLE_COLUMN       =>  User::STORE_OWNER_ROLE
                    ])
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

    public function create(string $storeId, array $attributes): User
    {
        Arr::set($attributes, User::STORE_ID_COLUMN, $storeId);
        Arr::set($attributes, User::EMAIL_COLUMN, strtolower($attributes[User::EMAIL_COLUMN]));
        
        return User::query()
                    ->create($attributes);
    }

    /**
     * @return User|false
     */
    public function update(User $user, array $attributes)
    {
        $userUpdated = User::query()
                            ->where(
                                [
                                    User::ID_COLUMN => $user->id
                                ]
                            )
                            ->update($attributes);

        if ($userUpdated) {
            return $user->refresh();
        }

        return false;
    }
}