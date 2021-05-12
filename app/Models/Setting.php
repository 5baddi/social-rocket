<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use BADDIServices\SocialRocket\Traits\HasUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory, HasUUID;

    /** @var array */
    public const COMMISSION_TYPES = [
        'fixed',
        'percentage'
    ];
    
    /** @var array */
    public const DISCOUNT_TYPES = [
        'fixed',
        'percentage'
    ];
    
    /** @var array */
    public const DISCOUNT_FORMATS = [
        'unique',
        'random'
    ];
}
