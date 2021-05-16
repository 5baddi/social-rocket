<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use SoftDeletes;
    
    /** @var array */
    public const STATUSES = [
        'pending',
        'active',
        'declined',
        'expired',
        'cancelled',
    ];

    /** @var string */
    public const USER_ID_COLUMN = 'user_id';
    public const STORE_ID_COLUMN = 'store_id';
    public const PACK_ID_COLUMN = 'pack_id';
    public const CHARGE_ID_COLUMN = 'charge_id';
    public const USAGE_ID_COLUMN = 'usage_id';
    public const STATUS_COLUMN = 'status';
    public const BILLING_ON_COLUMN = 'billing_on';
    public const ACTIVATED_ON_COLUMN = 'activated_on';
    public const TRIAL_ENDS_ON_COLUMN = 'trial_ends_on';
    public const CANCELLED_ON_COLUMN = 'cancelled_on';

    public const DEFAULT_STATUS = self::STATUSES[0];
    public const CHARGE_ACCEPTED = self::STATUSES[1];

    /** @var array */
    protected $fillable = [
        self::USER_ID_COLUMN,
        self::STORE_ID_COLUMN,
        self::PACK_ID_COLUMN,
        self::CHARGE_ID_COLUMN,
        self::USAGE_ID_COLUMN,
        self::STATUS_COLUMN,
        self::BILLING_ON_COLUMN,
        self::ACTIVATED_ON_COLUMN,
        self::TRIAL_ENDS_ON_COLUMN,
        self::CANCELLED_ON_COLUMN,
        self::CREATED_AT_COLUMN
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pack(): BelongsTo
    {
        return $this->belongsTo(Pack::class);
    }
}
