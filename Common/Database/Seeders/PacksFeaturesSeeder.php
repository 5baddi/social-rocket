<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Database\Seeders;

use BADDIServices\SocialRocket\Common\Entities\Subscription\Feature;
use BADDIServices\SocialRocket\Common\Entities\Subscription\Pack;
use BADDIServices\SocialRocket\Common\Entities\Subscription\PackFeature;
use BADDIServices\SocialRocket\Common\Repositories\Subscription\FeatureRepository;
use BADDIServices\SocialRocket\Common\Repositories\Subscription\PackFeatureRepository;
use BADDIServices\SocialRocket\Common\Repositories\Subscription\PackRepository;
use Illuminate\Database\Seeder;

class PacksFeaturesSeeder extends Seeder
{
    public function __construct(
        private PackRepository $packRepository,
        private FeatureRepository $featureRepository,
        private PackFeatureRepository $packFeatureRepository
    ) {}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packs = $this->packRepository->all();
        $features = $this->featureRepository
            ->all()
            ->sortBy(Feature::KEY_COLUMN);

        $packs->each(function (Pack $pack) use ($features) {
            $sort = 0;

            $features->each(function (Feature $feature) use ($pack, &$sort) {
                $this->packFeatureRepository->create([
                    PackFeature::PACK_ID_COLUMN     => $pack->getId(),
                    PackFeature::FEATURE_ID_COLUMN  => $feature->getId(),
                    PackFeature::SORT_ORDER_COLUMN  => ++$sort,
                ]);
            });
        });
    }
}
