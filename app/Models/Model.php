<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;
use BADDIServices\SocialRocket\Traits\HasUUID;

class Model extends BaseModel
{
    use HasUUID;

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public const ID_COLUMN = 'id';
}