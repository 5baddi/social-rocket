<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use BADDIServices\SocialRocket\Models\OAuth;
use BADDIServices\SocialRocket\Traits\HasUUID;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory, HasUUID;

    /** @var string */
    public const ID_COLUMN = 'id';
    public const SLUG_COLUMN = 'slug';
    public const USER_ID_COLUMN = 'user_id';

    /** @var array */
    protected $fillable = [
        'user_id',
        'slug',
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
}
