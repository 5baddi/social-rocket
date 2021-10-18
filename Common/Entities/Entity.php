<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Entities;

use BADDIServices\SocialRocket\Common\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Entity extends EloquentModel
{
    use HasUuid;

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

    /** @var array */
    protected $guarded = [];

    public function getId(): ?string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }
}
