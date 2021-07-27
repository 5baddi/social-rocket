<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Rules;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ValidateCurrentPassword implements Rule
{
    public function passes($attribute, $value)
    {
        /** @var User */
        $user = Auth::user();

        if (!$user->hasPassword()) {
            return true;
        }

        if (Hash::check($value, $user->getPassword())) {
            return true;
        }

        return false;
    }

    public function message()
    {
        return 'Current password is required.';
    }
}