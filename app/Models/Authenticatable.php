<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use BADDIServices\SocialRocket\Traits\HasUUID;
use Illuminate\Foundation\Auth\User as BaseUser;

class Authenticatable extends BaseUser
{
    use HasUUID;

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public const ID_COLUMN = 'id';
}