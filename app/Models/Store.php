<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use BADDIServices\SocialRocket\Entities\ModelEntity;
use BADDIServices\SocialRocket\Entities\StoreSetting;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends ModelEntity
{   
    /** @var string */
    public const NAME_COLUMN = 'name';
    public const EMAIL_COLUMN = 'email';
    public const DOMAIN_COLUMN = 'domain';
    public const SLUG_COLUMN = 'slug';
    public const PHONE_COLUMN = 'phone';
    public const COUNTRY_COLUMN = 'country';
    public const SCRIPT_TAG_ID_COLUMN = 'script_tag_id';
    public const CONNECTED_AT_COLUMN = 'connected_at';
    public const ENABLED_COLUMN = 'enabled';

    /** @var array */
    protected $casts = [
        self::ENABLED_COLUMN        => 'boolean',
        self::CONNECTED_AT_COLUMN   => 'datetime',
    ];

    private Setting|StoreSetting|null $setting;
    private OAuth|null $oauth;
    private User|null $owner;
    private Subscription|null $subscription;

    public function setSetting(?Setting $setting = null): self
    {
        $this->setting = $setting;

        return $this;
    }

    public function getSetting(): Setting|StoreSetting|null
    {
        return $this->setting ?? new StoreSetting();
    }
    
    public function setOAuth(OAuth $oauth): self
    {
        $this->oauth = $oauth;

        return $this;
    }

    public function getOAuth(): ?OAuth
    {
        return $this->oauth;
    }
    
    public function setOwner(User $user): self
    {
        $this->owner = $user;

        return $this;
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }
    
    public function setSubscription(Subscription $subscription): self
    {
        $this->subscription = $subscription;

        return $this;
    }

    public function getSubscription(): ?Subscription
    {
        return $this->subscription;
    }

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
