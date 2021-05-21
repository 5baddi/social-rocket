<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use BADDIServices\SocialRocket\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Commission extends BaseModel
{
    /** @var string */
    public const STORE_ID_COLUMN = 'store_id';
    public const ORDER_ID_COLUMN = 'order_id';
    public const AFFILIATE_ID_COLUMN = 'affiliate_id';
    public const AMOUNT_COLUMN = 'amount';
    public const STATUS_COLUMN = 'status';
    public const DEFAULT_STATUS = 'pending'; 
    public const PAID_STATUS = 'paid'; 
    public const REJECTED_STATUS = 'rejected'; 
    public const CANCELLED_STATUS = 'cancelled'; 

        /** @var array */
        public const STATUSES = [
            self::DEFAULT_STATUS,
            self::PAID_STATUS,
            self::REJECTED_STATUS,
            self::CANCELLED_STATUS
        ];

    /** @var array */
    protected $fillable = [
        self::STATUS_COLUMN,
        self::STORE_ID_COLUMN,
        self::ORDER_ID_COLUMN,
        self::AFFILIATE_ID_COLUMN,
        self::AMOUNT_COLUMN,
        self::STATUS_COLUMN,
    ];

    public function affiliate(): HasOne
    {
        return $this->hasOne(MailList::class, Commission::ID_COLUMN, Commission::AFFILIATE_ID_COLUMN);
    }
    
    public function order(): HasOne
    {
        return $this->hasOne(Order::class, Commission::ID_COLUMN, Commission::ORDER_ID_COLUMN);
    }
}