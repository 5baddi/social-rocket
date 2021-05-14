<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\Repositories\UserRespository;

class UserService extends Service
{
    /** @var UserRespository */
    private $userRepository;

    public function __construct(UserRespository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function create(array $attributes): User
    {
        $validator = Validator::make($attributes, [
            User::FIRST_NAME_COLUMN    => 'required|string|min:1',
            User::LAST_NAME_COLUMN     => 'required|string|min:1',
            User::EMAIL_COLUMN         => 'required|email',
            User::PASSWORD_COLUMN      => 'required|string',
            User::PHONE_COLUMN         => 'nullable|string|max:50'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $this->userRepository->create($attributes);
    }

    public function update(User $user, array $attributes): User
    {
        return $this->userRepository->update($user, $attributes);
    }
}