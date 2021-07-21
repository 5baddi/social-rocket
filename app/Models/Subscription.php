<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use BADDIServices\ClnkGO\Entities\ModelEntity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends ModelEntity
{
    use SoftDeletes;

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
    public const ACTIVE_STATUS = 'active';

    public const DEFAULT_STATUS = 'pending';
    public const CHARGE_ACCEPTED = 'active';
    public const CHARGE_CANCELLD = 'cancelled';
    public const CHARGE_DECLINED = 'declined';
    public const CHARGE_EXPIRED = 'expired';

    /** @var array */
    public const STATUSES = [
        self::DEFAULT_STATUS,
        self::CHARGE_ACCEPTED,
        self::CHARGE_DECLINED,
        self::CHARGE_EXPIRED,
        self::CHARGE_CANCELLD,
    ];

    /** @var array */
    protected $casts = [
        self::ACTIVATED_ON_COLUMN   => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pack(): BelongsTo
    {
        return $this->belongsTo(Pack::class);
    }
    
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function isUsageSubscription(): bool
    {
        return $this->getAttribute(self::USAGE_ID_COLUMN) !== null;
    }
    
    public function isChargeSubscription(): bool
    {
        return $this->getAttribute(self::CHARGE_ID_COLUMN) !== null;
    }
}
