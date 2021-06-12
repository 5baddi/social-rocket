<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use BADDIServices\SocialRocket\Entities\ModelEntity;
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
    public const STATUS_COLUMN = 'status';
    public const CANCELLED_ON_COLUMN = 'cancelled_on';

    public const DEFAULT_STATUS = self::STATUSES[0];

    /** @var array */
    protected $fillable = [
        self::USER_ID_COLUMN,
        self::STORE_ID_COLUMN,
        self::SUBSCRIPTION_ID_COLUMN,
        self::STATUS_COLUMN,
        self::CANCELLED_ON_COLUMN
    ];

    /** @var array */
    protected $casts = [
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
