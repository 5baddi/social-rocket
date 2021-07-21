<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use BADDIServices\ClnkGO\Entities\ModelEntity;

class Commission extends ModelEntity
{
    /** @var string */
    public const STORE_ID_COLUMN = 'store_id';
    public const ORDER_ID_COLUMN = 'order_id';
    public const AFFILIATE_ID_COLUMN = 'affiliate_id';
    public const AMOUNT_COLUMN = 'amount';
    public const STATUS_COLUMN = 'status';
    public const REASON_COLUMN = 'reason';
    public const PAYOUT_REFERENCE_COLUMN = 'payout_reference';
    public const PAYOUT_METHOD_COLUMN = 'payout_method';
    public const PAID_AT_COLUMN = 'paid_at';
    public const ADDITIONAL_INFO_COLUMN = 'additional_info';
    public const DEFAULT_STATUS = 'pending'; 
    public const IN_PROCESS_STATUS = 'in_process'; 
    public const PAID_STATUS = 'paid'; 
    public const REJECTED_STATUS = 'rejected'; 
    public const CANCELLED_STATUS = 'cancelled'; 

    /** @var array */
    public const STATUSES = [
        self::DEFAULT_STATUS,
        self::IN_PROCESS_STATUS,
        self::PAID_STATUS,
        self::REJECTED_STATUS,
        self::CANCELLED_STATUS
    ];

    /** @var array */
    protected $casts = [
        self::PAID_AT_COLUMN    => 'datetime',
    ];


    public function affiliate(): HasOne
    {
        return $this->hasOne(User::class, User::CUSTOMER_ID_COLUMN, Commission::AFFILIATE_ID_COLUMN);
    }
    
    public function order(): HasOne
    {
        return $this->hasOne(Order::class, Commission::ID_COLUMN, Commission::ORDER_ID_COLUMN);
    }
}