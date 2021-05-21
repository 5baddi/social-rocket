<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Entities;

use BADDIServices\SocialRocket\Models\Setting;

class StoreSetting
{
    /** @var array */
    public $payout_methods = [];

    /** @var bool */
    public $notify_new_account = false;
    public $notify_new_order = false;
    public $affiliate_form = false;
    public $thankyou_page = true;
    
    /** @var string */
    public $brand_name;
    public $commission_type = Setting::FIXED_TYPE;
    public $discount_type = Setting::FIXED_TYPE;
    public $discount_format = Setting::UNIQUE_DISCOUNT_FORMAT;
    public $color = Setting::DEFAULT_COLOR;
    public $currency = Setting::DEFAULT_CURRENCY;
    public $custom_share_text = null;

    /** @var float */
    public $commission_amount = Setting::DFEAULT_COMMISSION;
    public $discount_amount = Setting::DFEAULT_DISCOUNT;

    public function __construct() {}
}