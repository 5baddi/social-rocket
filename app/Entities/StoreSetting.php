<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Entities;

use BADDIServices\ClnkGO\Models\Setting;

class StoreSetting
{
    /** @var array */
    public $payout_methods = [];

    /** @var bool */
    public $notify_new_account = false;
    public $notify_new_order = false;
    public $affiliate_form = false;
    public $thankyou_page = true;
    public $purchase_mail = true;
    public $purchase_mail_24h = false;
    public $purchase_mail_48h = false;
    public $purchase_mail_120h = false;

    
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