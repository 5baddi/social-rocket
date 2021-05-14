<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Repositories;

use App\Models\User;

class UserRespository
{
    public function findByEmail(string $email): ?User
    {
        return User::query()
                    ->with(['subscripotion'])
                    ->where([
                        User::EMAIL_COLUMN => $email
                    ])
                    ->first();
    }

    public function create(array $attributes): User
    {
        return User::query()
                    ->create($attributes);
    }
}