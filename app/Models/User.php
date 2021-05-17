<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use BADDIServices\SocialRocket\Models\Subscription;
use BADDIServices\SocialRocket\Models\Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /** @var string */
    public const EMAIL_COLUMN = 'email';
    public const LAST_NAME_COLUMN = 'last_name';
    public const FIRST_NAME_COLUMN = 'first_name';
    public const PHONE_COLUMN = 'phone';
    public const PASSWORD_COLUMN = 'password';
    public const CUSTOMER_ID_COLUMN = 'customer_id';
    public const LAST_LOGIN_COLUMN = 'last_login';
    public const REMEMBER_TOLEN = 'remember_token';

    /** @var array */
    protected $fillable = [
        self::FIRST_NAME_COLUMN,
        self::LAST_NAME_COLUMN,
        self::EMAIL_COLUMN,
        self::PHONE_COLUMN,
        self::PASSWORD_COLUMN,
        self::LAST_LOGIN_COLUMN,
        self::CUSTOMER_ID_COLUMN,
    ];

    /** @var array */
    protected $hidden = [
        self::PASSWORD_COLUMN,
        self::REMEMBER_TOLEN,
    ];

    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
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
        return !is_null($this->attributes[self::CUSTOMER_ID_COLUMN]);
    }
}
