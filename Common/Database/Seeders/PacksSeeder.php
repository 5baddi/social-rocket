<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Database\Seeders;

use BADDIServices\SocialRocket\Common\Entities\Subscription\Pack;
use BADDIServices\SocialRocket\Common\Services\Subscription\PackService;
use Illuminate\Database\Seeder;

class PacksSeeder extends Seeder
{
    /** @var PackService */
    private $packService;

    public function __construct(PackService $packService)
    {
        $this->packService = $packService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->packService->bulkCreate([
            [
                Pack::NAME_KEY_COLUMN               => 'entrepreneur',
                Pack::PRICE_COLUMN                  => 0,
                Pack::TYPE_COLUMN                   => Pack::FREE_TYPE,
                Pack::REVENUE_SHARE_COLUMN          => 0.12,
            ]
        ]);
    }
}
