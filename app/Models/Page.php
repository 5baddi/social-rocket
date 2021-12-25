<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use BADDIServices\SocialRocket\Entities\ModelEntity;

class Page extends ModelEntity
{
    /** @var string */
    public const SLUG_COLUMN = 'slug';
    public const TITLE_COLUMN = 'title';
    public const CONTENT_COLUMN = 'content';
    public const PUBLISHED_AT_COLUMN = 'published_at';
}
