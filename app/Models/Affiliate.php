<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Models;

use Illuminate\Database\Eloquent\Relations\HasOne;
use BADDIServices\ClnkGO\Entities\ModelEntity;

class Affiliate extends ModelEntity
{
    /** @var string */
    public const STORE_ID_COLUMN = 'store_id';
    public const CUSTOMER_ID_COLUMN = 'customer_id';
    public const EMAIL_COLUMN = 'email';
    public const LAST_NAME_COLUMN = 'last_name';
    public const FIRST_NAME_COLUMN = 'first_name';
    public const COUPON_COLUMN = 'coupon';

    public function store(): HasOne
    {
        return $this->hasOne(Store::class);
    }

    public function getFullName(): ?string
    {
        return ucwords($this->getAttribute(self::FIRST_NAME_COLUMN) . ' ' . $this->getAttribute(self::LAST_NAME_COLUMN));
    }
}