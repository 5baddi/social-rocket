<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Managers;

use App\Models\User;
use BADDIServices\SocialRocket\Common\Repositories\UserRepository;
use BADDIServices\SocialRocket\Managers\Cache\CacheManager;

class UserManager extends CacheManager
{
    public function __construct(UserRepository $userRepository)
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
