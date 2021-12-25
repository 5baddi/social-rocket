<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Models;

use BADDIServices\SocialRocket\Entities\ModelEntity;
use Carbon\Carbon;

class Page extends ModelEntity
{
    /** @var string */
    public const SLUG_COLUMN = 'slug';
    public const TITLE_COLUMN = 'title';
    public const CONTENT_COLUMN = 'content';
    public const MAIN_MENU_COLUMN = 'main_menu';
    public const PUBLISHED_AT_COLUMN = 'published_at';

    public function getSlug(): string
    {
        return $this->getAttribute(self::SLUG_COLUMN);
    }
    
    public function getTitle(): string
    {
        return $this->getAttribute(self::TITLE_COLUMN);
    }
    
    public function getContent(): ?string
    {
        return $this->getAttribute(self::CONTENT_COLUMN);
    }
    
    public function isMainMenu(): bool
    {
        return $this->getAttribute(self::MAIN_MENU_COLUMN) === true;
    }
    
    public function getPublishedAt(): ?Carbon
    {
        return $this->getAttribute(self::PUBLISHED_AT_COLUMN);
    }
}
