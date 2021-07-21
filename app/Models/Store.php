<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use BADDIServices\ClnkGO\Entities\ModelEntity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends ModelEntity
{   
    /** @var string */
    public const TABLE_NAME = 'stores';
    public const NAME_COLUMN = 'name';
    public const EMAIL_COLUMN = 'email';
    public const DOMAIN_COLUMN = 'domain';
    public const MYSHOPIFY_DOMAIN_COLUMN = 'myshopify_domain';
    public const SLUG_COLUMN = 'slug';
    public const PHONE_COLUMN = 'phone';
    public const COUNTRY_COLUMN = 'country';
    public const SCRIPT_TAG_ID_COLUMN = 'script_tag_id';
    public const CONNECTED_AT_COLUMN = 'connected_at';
    public const ENABLED_COLUMN = 'enabled';
    public const SHOP_ID_COLUMN = 'store_id';
    public const TIMEZONE_COLUMN = 'timezone';
    public const LOCALE_COLUMN = 'locale';
    public const CURRENCY_COLUMN = 'currency';
    public const CURRENCY_SYMBOL_COLUMN = 'currency_symbol';

    /** @var array */
    protected $casts = [
        self::ENABLED_COLUMN        => 'boolean',
        self::CONNECTED_AT_COLUMN   => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function setting(): HasOne
    {
        return $this->hasOne(Setting::class);
    }
    
    public function oauth(): HasOne
    {
        return $this->hasOne(OAuth::class);
    }

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }

    public function affiliates(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function isEnabled(): bool
    {
        return $this->getAttribute(self::ENABLED_COLUMN) === true;
    }
}
