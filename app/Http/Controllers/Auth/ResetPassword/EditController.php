<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Auth\ResetPassword;

use App\Models\User;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class EditController extends Controller
{
    public function __invoke(string $token)
    {
        $user = $this->userService->verifyResetPasswordToken($token);
        abort_if(!$user instanceof User, Response::HTTP_NOT_FOUND);

        return view('auth.password', [
            'token'     =>  $token
        ]);
    }
}