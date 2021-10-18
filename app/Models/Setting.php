<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use BADDIServices\SocialRocket\Entities\ModelEntity;

class Setting extends ModelEntity
{
    /** @var string */
    public const FIXED_TYPE = 'fixed';
    public const PERCENTAGE_TYPE = 'percentage';
    public const UNIQUE_DISCOUNT_FORMAT = 'unique';
    public const RANDOM_DISCOUNT_FORMAT = 'random';
    public const DEFAULT_COLOR = '#04AF90';
    public const DEFAULT_CURRENCY = 'USD';
    public const DEFAULT_PAYMENT_METHOD = 'paypal';

    public const STORE_ID_COLUMN = 'store_id';
    public const CURRENCY_COLUMN = 'currency';
    public const BRAND_NAME_COLUMN = 'brand_name';
    public const COMMISSION_TYPE_COLUMN = 'commission_type';
    public const DISCOUNT_TYPE_COLUMN = 'discount_type';
    public const COMMISSION_AMOUNT_COLUMN = 'commission_amount';
    public const DISCOUNT_AMOUNT_COLUMN = 'discount_amount';
    public const DISCOUNT_FORMAT_COLUMN = 'discount_format';
    public const COLOR_COLUMN = 'color';
    public const PAYOUT_METHODS_COLUMN = 'payout_methods';
    public const NOTIFY_NEW_ACCOUNT_COLUMN = 'notify_new_account';
    public const NOTIFY_NEW_OREDR_COLUMN = 'notify_new_order';
    public const AFFILIATE_FORM_COLUMN = 'affiliate_form';
    public const PURCHASE_MAIL_COLUMN = 'purchase_mail';
    public const PURCHASE_MAIL_24H_COLUMN = 'purchase_mail_24h';
    public const PURCHASE_MAIL_48H_COLUMN = 'purchase_mail_48h';
    public const PURCHASE_MAIL_120H_COLUMN = 'purchase_mail_120h';
    public const THANKYOU_PAGE_COLUMN = 'thankyou_page';
    public const CUSTOM_SHARE_TEXT_COLUMN = 'custom_share_text';

    /** @var int */
    public const DFEAULT_COMMISSION = 10;
    public const DFEAULT_DISCOUNT= 10;

    /** @var array */
    public const COMMISSION_TYPES = [
        self::FIXED_TYPE,
        self::PERCENTAGE_TYPE,
    ];

    public const DISCOUNT_TYPES = [
        self::FIXED_TYPE,
        self::PERCENTAGE_TYPE,
    ];

    public const DISCOUNT_FORMATS = [
        self::UNIQUE_DISCOUNT_FORMAT    =>  'First Name + Unique Number',
        self::RANDOM_DISCOUNT_FORMAT    =>  'Random Letters + Numbers'
    ];

    public const PAYOUT_METHODS = [
        'bank',
        'paypal',
        'venmo',
        'zelle',
        'cashapp'
    ];

    /** @var array */
    protected $fillable = [
        self::STORE_ID_COLUMN,
        self::BRAND_NAME_COLUMN,
        self::COMMISSION_TYPE_COLUMN,
        self::DISCOUNT_TYPE_COLUMN,
        self::COMMISSION_AMOUNT_COLUMN,
        self::DISCOUNT_AMOUNT_COLUMN,
        self::DISCOUNT_FORMAT_COLUMN,
        self::COLOR_COLUMN,
        self::CURRENCY_COLUMN,
        self::PAYOUT_METHODS_COLUMN,
        self::NOTIFY_NEW_ACCOUNT_COLUMN,
        self::NOTIFY_NEW_OREDR_COLUMN,
        self::AFFILIATE_FORM_COLUMN,
        self::THANKYOU_PAGE_COLUMN,
        self::CUSTOM_SHARE_TEXT_COLUMN,
        self::PURCHASE_MAIL_COLUMN,
        self::PURCHASE_MAIL_24H_COLUMN,
        self::PURCHASE_MAIL_48H_COLUMN,
        self::PURCHASE_MAIL_120H_COLUMN,
    ];

    /** @var array */
    protected $casts = [
        self::COMMISSION_AMOUNT_COLUMN  => 'float',
        self::DISCOUNT_AMOUNT_COLUMN    => 'float',
        self::NOTIFY_NEW_ACCOUNT_COLUMN => 'boolean',
        self::NOTIFY_NEW_OREDR_COLUMN   => 'boolean',
        self::AFFILIATE_FORM_COLUMN     => 'boolean',
        self::THANKYOU_PAGE_COLUMN      => 'boolean',
        self::PAYOUT_METHODS_COLUMN     => 'json',
    ];

    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
    }

    public function getPayoutMethodsAttribute($value): array
    {
        if (is_null($this->attributes[self::PAYOUT_METHODS_COLUMN])) {
            return [];
        }

        return json_decode($this->attributes[self::PAYOUT_METHODS_COLUMN]);
    }

    public function setCurrencyAttribute($value): self
    {
        $this->attributes[self::CURRENCY_COLUMN] = strtoupper($value);

        return $this;
    }

    public function setPayoutMethodsAttribute($value): self
    {
        $this->attributes[self::PAYOUT_METHODS_COLUMN] = json_encode($value);

        return $this;
    }
}
