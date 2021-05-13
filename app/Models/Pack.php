<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use BADDIServices\SocialRocket\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pack extends Model
{
    use HasFactory, HasUUID;

    /** @var string */
    public const PER_MONTH = 'month';

    /** @var int */
    public const DEFAULT_TRIAL_DAYS = 7;

    /** @var array */
    public const PAYMENT_CYCLES = [
        self::PER_MONTH
    ];

    /** @var array */
    public const PRICE_TYPES = [
        'fixed',
        'percentage'
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }
}
