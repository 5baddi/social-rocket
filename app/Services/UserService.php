<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Setting;
use Illuminate\Validation\ValidationException;
use BADDIServices\SocialRocket\Repositories\UserRespository;
use BADDIServices\SocialRocket\Notifications\Affiliate\NewAffiliateAccount;

class UserService extends Service
{
    /** @var UserRespository */
    private $userRepository;

    public function __construct(UserRespository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function verifyPassword(User $user, string $password): bool
    {
        return Hash::check($password, $user->password);
    }

    public function exists(int $customerId): ?User
    {
        return $this->userRepository->exists($customerId);
    }
    
    public function findByEmail(string $email): ?User
    {
        return $this->userRepository->findByEmail($email);
    }

    public function create(Store $store, array $attributes): User
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

        return $this->userRepository->create($store->id, $attributes);
    }

    public function update(User $user, array $attributes): User
    {
        $attributes = collect([
            User::FIRST_NAME_COLUMN     => $attributes[User::FIRST_NAME_COLUMN],
            User::LAST_NAME_COLUMN      => $attributes[User::LAST_NAME_COLUMN],
            User::EMAIL_COLUMN          => $attributes[User::EMAIL_COLUMN],
            User::PHONE_COLUMN          => $attributes[User::PHONE_COLUMN],
            User::PASSWORD_COLUMN       => $attributes[User::PASSWORD_COLUMN],
        ]);

        $filterAttributes = $attributes->filter(function($value, $key) {
            return $value !== null;
        });

        return $this->userRepository->update($user, $filterAttributes->toArray());
    }

    public function welcomeMail(User $user): void
    {
        
    }
    
    public function notifyStoreOwner(Store $store, User $affiliate): void
    {
        $store->load(['user', 'setting']);
        
        /** @var User */
        $user = $store->user;

        /** @var Setting */
        $setting = $store->setting;

        $user->notify(new NewAffiliateAccount($user, $affiliate, $setting));
    }
}