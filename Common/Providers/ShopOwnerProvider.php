<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Providers;

use Illuminate\Auth\EloquentUserProvider;
use BADDIServices\SocialRocket\Services\UserService;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;

class ShopOwnerProvider extends EloquentUserProvider 
{
    /** @var UserService */
    private $userService;

    public function __construct(HasherContract $hasher, $model)
    {
        parent::__construct($hasher, $model);

        /** @var UserService */
        $this->userService = app(UserService::class);
    }

    public function retrieveById($identifier)
    {
        return $this->userService->findById($identifier);
    }
}