<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Models;

use BADDIServices\ClnkGO\Traits\HasUUID;
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