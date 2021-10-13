<?php

/**
 * Social Rocket
 *
 * @package Shopify
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Packages\Shopify\Listeners;

use BADDIServices\Packages\Shopify\Events\ShopConnected;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterScriptTag implements ShouldQueue
{
    public function handle(ShopConnected $event)
    {

    }
}
