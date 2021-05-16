<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;

class MailList extends Model
{
    /** @var string */
    public const STORE_ID_COLUMN = 'store_id';
    public const EMAIL_COLUMN = 'email';
    public const LAST_NAME_COLUMN = 'last_name';
    public const FIRST_NAME_COLUMN = 'first_name';
    public const CONFIRMED_COLUMN = 'confirmed';

    /** @var array */
    protected $fillable = [
        self::STORE_ID_COLUMN,
        self::FIRST_NAME_COLUMN,
        self::LAST_NAME_COLUMN,
        self::EMAIL_COLUMN,
        self::CONFIRMED_COLUMN,
    ];

    /** @var array */
    protected $casts = [
        self::CONFIRMED_COLUMN => 'boolean',
    ];

    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
    }
}