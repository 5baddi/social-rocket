<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Managers;

use App\Models\User;
use BADDIServices\SocialRocket\Repositories\UserRespository;

class UserManager// extends Service
{
    /** @var UserRespository */
    private $userRepository;

    public function __construct(UserRespository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findById(string $id): ?User
    {
        return $this->userRepository->findById($id);
    }
}