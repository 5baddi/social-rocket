<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use BADDIServices\SocialRocket\Models\MailList;
use Illuminate\Database\Eloquent\Collection;

class MailListRepository
{
    public function all(): Collection
    {
        return MailList::query()
                    ->all();
    }
    
    public function create(array $attributes): MailList
    {
        return MailList::query()
                    ->create($attributes);
    }
    
    public function exists(string $email): bool
    {
        return MailList::query()
                    ->where(MailList::EMAIL_COLUMN, $email)
                    ->exists();
    }
}