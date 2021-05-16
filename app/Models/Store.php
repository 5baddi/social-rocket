<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Store extends Model
{
    use SoftDeletes;
    
    /** @var string */
    public const SLUG_COLUMN = 'slug';
    public const USER_ID_COLUMN = 'user_id';
    public const SCRIPT_TAG_ID_COLUMN = 'script_tag_id';
    public const COUPON_COLUMN = 'coupon';

    /** @var array */
    protected $fillable = [
        self::USER_ID_COLUMN,
        self::SLUG_COLUMN,
        self::SCRIPT_TAG_ID_COLUMN,
        self::COUPON_COLUMN
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

    public function mailList(): HasMany
    {
        return $this->hasMany(MailList::class);
    }
}
