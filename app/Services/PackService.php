<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use App\Models\User;
use BADDIServices\SocialRocket\Common\Validators\Subscription\PackValidator;
use BADDIServices\SocialRocket\Models\Pack;
use Illuminate\Database\Eloquent\Collection;
use BADDIServices\SocialRocket\Models\Subscription;
use BADDIServices\SocialRocket\Repositories\PackRepository;
use Illuminate\Support\Arr;

class PackService extends Service
{
    /** @var PackRepository */
    private $packRepository;

    /** @var PackValidator */
    private $packValidator;

    public function __construct(PackRepository $packRepository, PackValidator $packValidator)
    {
        $this->packRepository = $packRepository;
        $this->packValidator = $packValidator;
    }

    public function all(): Collection
    {
        return $this->packRepository->all();
    }

    public function findById(string $id): Pack
    {
        return $this->packRepository->findById($id);
    }

    public function loadCurrentPack(User $user): ?Pack
    {
        $user->load('subscription');

        /** @var Subscription */
        $subscription = $user->subscription;

        if (!is_null($subscription)) {
            $subscription->load('pack');

            return $subscription->pack;
        }

        return null;
    }

    public function create(array $attributes): Pack
    {
        $attributes = $this->format($attributes);

        $this->packValidator->validate($attributes);

        return $this->packRepository->create($attributes);
    }

    public function update(Pack $pack, array $attributes): Pack
    {
        $attributes = $this->format($attributes);

        $this->packValidator->validate($attributes);

        return $this->packRepository->update(
            [Pack::ID_COLUMN => $pack->getId()],
            $attributes
        );
    }

    public function bulkCreate(array $packs): array
    {
        $result = [];

        foreach ($packs as $pack) {
            $result[] = $this->create($pack);
        }

        return $result;
    }

    private function format(array $attributes): array
    {
        $attributes = Arr::only(
            $attributes,
            [
                Pack::NAME_KEY_COLUMN,
                Pack::PRICE_COLUMN,
                Pack::TYPE_COLUMN,
                Pack::INTERVAL_COLUMN,
                Pack::REVENUE_SHARE_COLUMN,
                Pack::IS_POPULAR_COLUMN,
                Pack::TRIAL_DAYS_COLUMN,
                Pack::CURRENCY_COLUMN,
                Pack::CURRENCY_SYMBOL_COLUMN,
            ]
        );

        if (! Arr::has($attributes, Pack::INTERVAL_COLUMN)) {
            $attributes[Pack::INTERVAL_COLUMN] = Pack::PER_MONTH;
        }

        if (
            $attributes[Pack::TYPE_COLUMN] === Pack::FREE_TYPE &&
            ! Arr::has($attributes, Pack::TRIAL_DAYS_COLUMN)
        ) {
            $attributes[Pack::TRIAL_DAYS_COLUMN] = Pack::DEFAULT_TRIAL_DAYS;
        }

        if (
            $attributes[Pack::TYPE_COLUMN] === Pack::DEFAULT_CHARGE_PRICE &&
            Arr::get($attributes, Pack::PRICE_COLUMN, 0) < Pack::DEFAULT_CHARGE_PRICE
        ) {
            $attributes[Pack::PRICE_COLUMN] = Pack::DEFAULT_CHARGE_PRICE;
        }

        return $attributes;
    }
}
