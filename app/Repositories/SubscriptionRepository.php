<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use BADDIServices\SocialRocket\Models\Subscription;

class SubscriptionRepository
{
    public function paginateWithRelations(?int $page = null): LengthAwarePaginator
    {
        return Subscription::query()
                    ->with(['user', 'pack', 'store'])
                    ->where(Subscription::USER_ID_COLUMN, '!=', Auth::id())
                    ->paginate(10, ['*'], 'ap', $page);
    }

    public function getUsageBills(): Collection
    {
        return Subscription::query()
                    ->whereNotNull(Subscription::USAGE_ID_COLUMN)
                    ->get();
    }

    public function save(string $userId, string $storeId, string $packId, array $attributes): Subscription
    {
        $attributes = array_merge($attributes, [
            Subscription::USER_ID_COLUMN    => $userId,
            Subscription::STORE_ID_COLUMN   => $storeId,
            Subscription::PACK_ID_COLUMN    => $packId,
        ]);

        return Subscription::query()
                    ->updateOrCreate(
                        [
                            Subscription::USER_ID_COLUMN    => $userId,
                            Subscription::STORE_ID_COLUMN   => $storeId,
                        ],
                        $attributes
                    );
    }

    public function delete(string $id): bool
    {
        return Subscription::query()
                    ->where(Subscription::ID_COLUMN, $id)
                    ->delete() === 1;
    }
}