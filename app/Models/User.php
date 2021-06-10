<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Database\Eloquent\Relations\HasOne;
use BADDIServices\SocialRocket\Models\Subscription;
use BADDIServices\SocialRocket\Models\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use Notifiable;

    /** @var string */
    public const EMAIL_COLUMN = 'email';
    public const LAST_NAME_COLUMN = 'last_name';
    public const FIRST_NAME_COLUMN = 'first_name';
    public const PHONE_COLUMN = 'phone';
    public const PASSWORD_COLUMN = 'password';
    public const CUSTOMER_ID_COLUMN = 'customer_id';
    public const LAST_LOGIN_COLUMN = 'last_login';
    public const REMEMBER_TOLEN_COLUMN = 'remember_token';
    public const ROLE_COLUMN = 'role';
    public const IS_SUPERADMIN_COLUMN = 'is_superadmin';
    public const BANNED_COLUMN = 'banned';
    public const COUPON_COLUMN = 'coupon';
    public const STORE_ID_COLUMN = 'store_id';
    public const DEFAULT_ROLE = 'affiliate';
    public const STORE_OWNER_ROLE = 'store-owner';

    /** @var array */
    public const ROLES = [
        self::DEFAULT_ROLE,
        'store-owner'
    ];

    /** @var array */
    protected $fillable = [
        self::FIRST_NAME_COLUMN,
        self::LAST_NAME_COLUMN,
        self::EMAIL_COLUMN,
        self::PHONE_COLUMN,
        self::PASSWORD_COLUMN,
        self::LAST_LOGIN_COLUMN,
        self::CUSTOMER_ID_COLUMN,
        self::REMEMBER_TOLEN_COLUMN,
        self::ROLE_COLUMN,
        self::STORE_ID_COLUMN,
        self::COUPON_COLUMN,
        self::IS_SUPERADMIN_COLUMN,
    ];

    /** @var array */
    protected $hidden = [
        self::PASSWORD_COLUMN,
        self::REMEMBER_TOLEN_COLUMN,
    ];

    /** @var array */
    protected $casts = [
        self::CREATED_AT                => 'datetime',
        self::UPDATED_AT                => 'datetime',
        self::LAST_LOGIN_COLUMN         => 'datetime',
        self::IS_SUPERADMIN_COLUMN      => 'boolean',
        self::BANNED_COLUMN             => 'boolean',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
    
    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class, 'user_id');
    }

    public function setEmailAttribute($value): self
    {
        $this->attributes[self::EMAIL_COLUMN] = strtolower($value);

        return $this;
    }
    
    public function setPasswordAttribute($value): self
    {
        $this->attributes[self::PASSWORD_COLUMN] = Hash::make($value);

        return $this;
    }

    public function isAffiliateAccount(): bool
    {
        return !is_null($this->attributes[self::CUSTOMER_ID_COLUMN]) || $this->getAttribute(self::ROLE_COLUMN) === self::DEFAULT_ROLE;
    }

    public function getFullName(): ?string
    {
        return ucwords($this->getAttribute(self::FIRST_NAME_COLUMN) . ' ' . $this->getAttribute(self::LAST_NAME_COLUMN));
    }

    public function isSuperAdmin(): bool
    {
        return $this->getAttribute(self::IS_SUPERADMIN_COLUMN) === true && is_null($this->getAttribute(self::ROLE_COLUMN));
    }
    
    public function isBanned(): bool
    {
        return $this->getAttribute(self::BANNED_COLUMN) === true;
    }
}
