<?php

namespace BADDIServices\ClnkGO\Models;

use BADDIServices\ClnkGO\Entities\ModelEntity;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OAuth extends ModelEntity
{
    /** @var string */
    public const TABLE_NAME = 'oauths';
    public const STORE_ID_COLUMN = 'store_id';
    public const CODE_COLUMN = 'code';
    public const ACCESS_TOKEN_COLUMN = 'access_token';
    public const SCOPE_COLUMN = 'scope';
    public const TIMESTAMP_COLUMN = 'timestamp';

    /** @var string */
    protected $table = self::TABLE_NAME;

    /** @var array */
    protected $casts = [
        self::TIMESTAMP_COLUMN => 'integer',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
