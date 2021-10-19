<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class SignInController extends Controller
{
    public function __invoke()
    {
        return $this->renderView('auth.signin');
    }
}
