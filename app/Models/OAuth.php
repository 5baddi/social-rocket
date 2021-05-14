<?php

namespace BADDIServices\SocialRocket\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OAuth extends Model
{
    /** @var string */
    public const STORE_ID = 'store_id';

    /** @var array */
    protected $fillable = [
        self::STORE_ID,
        'code',
        'access_token',
        'scope',
        'timestamp',
    ];

    /** @var array */
    protected $casts = [
        'timestamp' => 'integer',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
