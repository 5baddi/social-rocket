<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Entities;

use Illuminate\Database\Eloquent\Model as EloquentModel;
use BADDIServices\SocialRocket\Traits\HasUUID;

class ModelEntity extends EloquentModel
{
    use HasUUID;

    /** @var string */
    public const ID_COLUMN = 'id';
    public const DELETED_AT_COLUMN = 'deleted_at';
    public const UPDATED_AT_COLUMN = self::UPDATED_AT;
    public const CREATED_AT_COLUMN = self::CREATED_AT;

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $primaryKey = 'id';
    protected $keyType = 'string';
}