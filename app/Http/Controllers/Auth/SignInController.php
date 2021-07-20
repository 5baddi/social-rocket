<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class SignInController extends Controller
{
    public function __invoke()
    {
        return view('auth.signin');
    }
}