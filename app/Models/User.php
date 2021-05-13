<?php

namespace App\Models;

use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Subscription;
use BADDIServices\SocialRocket\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUUID;

    /** @var string */
    public const EMAIL_COLUMN = 'email';
    public const LAST_NAME_COLUMN = 'last_name';
    public const FIRST_NAME_COLUMN = 'first_name';
    public const PHONE_COLUMN = 'phone';
    public const PASSWORD_COLUMN = 'password';
    public const CURRENCY_COLUMN = 'currency';
    public const BRAND_NAME_COLUMN = 'brand_name';

    /** @var string */
    protected $primaryKey = 'id';

    /** @var array */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];

    /** @var array */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @var array */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
    }
    
    public function subscripotion(): HasOne
    {
        return $this->hasOne(Subscription::class);
    }

    public function setPasswordAttribute($value): self
    {
        $this->setAttribute(self::PASSWORD_COLUMN, Hash::make($value));

        return $this;
    }
}
