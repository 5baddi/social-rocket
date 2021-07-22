<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BADDIServices\ClnkGO\Models\Store;

class SignUpController extends Controller
{
    public function __invoke(Store $store)
    {
        return view('auth.signup', ['store' => $store]);
    }
}