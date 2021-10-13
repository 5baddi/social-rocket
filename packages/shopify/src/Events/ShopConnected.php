<?php

/**
 * Social Rocket
 *
 * @package Shopify
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Packages\Shopify\Events;

use BADDIServices\Packages\Shopify\Entities\Shop;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShopConnected
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var Shop */
    public $shop;

    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }
}
