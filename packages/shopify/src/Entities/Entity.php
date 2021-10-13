<?php

/**
 * Social Rocket
 *
 * @package Shopify
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Packages\Shopify\Entities;

use BADDIServices\Packages\Shopify\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class Entity extends Model
{
    use HasUuid, SoftDeletes;

    public const ID_COLUMN = 'id';
    public const DELETED_AT_COLUMN = 'deleted_at';
    public const UPDATED_AT_COLUMN = self::UPDATED_AT;
    public const CREATED_AT_COLUMN = self::CREATED_AT;

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    /** @var array */
    protected $guarded = [];

    public function getId(): ?string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->getAttribute(self::CREATED_AT_COLUMN);
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->getAttribute(self::UPDATED_AT_COLUMN);
    }

    public function getDeletedAt(): ?Carbon
    {
        return $this->getAttribute(self::DELETED_AT_COLUMN);
    }
}
