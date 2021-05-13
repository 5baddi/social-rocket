<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class SignUpController extends Controller
{
    public function __invoke()
    {
        if (!Session::has('slug')) {
            return redirect('/connect');
        }

        return view('auth.signup');
    }
}