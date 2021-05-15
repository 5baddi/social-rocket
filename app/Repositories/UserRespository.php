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
                    ->where([
                        User::EMAIL_COLUMN => strtolower($email)
                    ])
                    ->first();
    }

    public function create(array $attributes): User
    {
        $attributes[User::EMAIL_COLUMN] = strtolower($attributes[User::EMAIL_COLUMN]);
        
        return User::query()
                    ->create($attributes);
    }

    /**
     * @return User|false
     */
    public function update(User $user, array $attributes)
    {
        $userUpdated = User::query()
                            ->where(
                                [
                                    User::ID_COLUMN => $user->id
                                ]
                            )
                            ->update($attributes);

        if ($userUpdated) {
            return $user->refresh();
        }

        return false;
    }
}