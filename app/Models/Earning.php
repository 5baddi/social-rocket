<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use BADDIServices\ClnkGO\Entities\ModelEntity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Earning extends ModelEntity
{
    use SoftDeletes;
    
    /** @var array */
    public const STATUSES = [
        'active',
        'cancelled',
    ];

    /** @var string */
    public const USER_ID_COLUMN = 'user_id';
    public const STORE_ID_COLUMN = 'store_id';
    public const SUBSCRIPTION_ID_COLUMN = 'subscription_id';
    public const AMOUNT_COLUMN = 'amount';
    public const STATUS_COLUMN = 'status';
    public const ACTIVATED_ON_COLUMN = 'activated_on';
    public const CANCELLED_ON_COLUMN = 'cancelled_on';

    public const DEFAULT_STATUS = self::STATUSES[0];

    /** @var array */
    protected $casts = [
        self::ACTIVATED_ON_COLUMN   => 'datetime',
        self::CANCELLED_ON_COLUMN   => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}
