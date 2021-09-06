<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Managers;

use App\Models\User;
use BADDIServices\SocialRocket\Managers\Cache\CacheManager;
use BADDIServices\SocialRocket\Repositories\UserRespository;

class UserManager extends CacheManager
{
    public function __construct(UserRespository $userRepository)
    {
        parent::__construct();

        $this->eloquentRepository = $userRepository;
    }

    public function findById(string $id): ?User
    {
        $user = parent::get($id);
        if ($user instanceof User) {
            return $user;
        }

        $user = $this->eloquentRepository->findById($id);
        if ($user instanceof User) {
            parent::set($user->getEmail(), $user);
        }

        return $user;
    }
}