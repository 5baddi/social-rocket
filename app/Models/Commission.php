<?php

namespace App\Models;

use BADDIServices\SocialRocket\Models\BaseModel;

class Commission extends BaseModel
{
    /** @var array */
    public const STATUSES = [
        'pending',
        'paid',
        'rejected',
        'cancelled',
    ];

    /** @var string */
    public const STORE_ID_COLUMN = 'store_id';
    public const ORDER_ID_COLUMN = 'order_id';
    public const AFFILIATE_ID_COLUMN = 'affiliate_id';
    public const AMOUNT_COLUMN = 'amount';
    public const STATUS_COLUMN = 'status';
    public const DEFAULT_STATUS = self::STATUSES[0]; 

    /** @var array */
    protected $fillable = [
        self::STATUS_COLUMN,
        self::STORE_ID_COLUMN,
        self::ORDER_ID_COLUMN,
        self::AFFILIATE_ID_COLUMN,
        self::AMOUNT_COLUMN,
        self::STATUS_COLUMN,
    ];
}