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

class Store extends BaseModel
{
    use SoftDeletes;
    
    /** @var string */
    public const TABLE_NAME = 'stores';
    public const SLUG_COLUMN = 'slug';
    public const SCRIPT_TAG_ID_COLUMN = 'script_tag_id';

    /** @var array */
    protected $fillable = [
        self::SLUG_COLUMN,
        self::SCRIPT_TAG_ID_COLUMN,
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
}
