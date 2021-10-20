<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Database\Seeders;

use BADDIServices\SocialRocket\App;
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
                Pack::KEY_COLUMN                    => Pack::ENTREPRENEUR,
                Pack::NAME_KEY_COLUMN               => 'entrepreneur',
                Pack::PRICE_COLUMN                  => 0,
                Pack::TYPE_COLUMN                   => Pack::FREE_TYPE,
                Pack::REVENUE_SHARE_COLUMN          => 0.25,
            ],
            [
                Pack::KEY_COLUMN                    => Pack::SMALL_BUSINESS,
                Pack::NAME_KEY_COLUMN               => 'small_business',
                Pack::PRICE_COLUMN                  => 49,
                Pack::TYPE_COLUMN                   => Pack::USAGE_TYPE,
                Pack::REVENUE_SHARE_COLUMN          => 0.12,
                Pack::IS_POPULAR_COLUMN             => true,
                Pack::CURRENCY_COLUMN               => App::DEFAULT_CURRENCY,
                Pack::CURRENCY_SYMBOL_COLUMN        => App::DEFAULT_CURRENCY_SYMBOL,
            ],
            [
                Pack::KEY_COLUMN                    => Pack::AGENCY,
                Pack::NAME_KEY_COLUMN               => 'agency',
                Pack::PRICE_COLUMN                  => 120,
                Pack::TYPE_COLUMN                   => Pack::RECURRING_TYPE,
                Pack::CURRENCY_COLUMN               => App::DEFAULT_CURRENCY,
                Pack::CURRENCY_SYMBOL_COLUMN        => App::DEFAULT_CURRENCY_SYMBOL,
            ]
        ]);
    }
}
