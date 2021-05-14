<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    /** @var int */
    public const STRIPE_GATEWAY = 1;

    /** @var string */
    public const USER_ID_COLUMN = 'user_id';
    public const PACK_ID_COLUMN = 'pack_id';

    /** @var array */
    public const PAYMENT_GATEWAYS = [
        self::STRIPE_GATEWAY
    ];

    /** @var array */
    protected $fillable = [
        self::USER_ID_COLUMN,
        self::PACK_ID_COLUMN,
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
