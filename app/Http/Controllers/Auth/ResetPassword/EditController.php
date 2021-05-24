<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Controllers\Auth\ResetPassword;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class EditController extends Controller
{
    public function __invoke(string $token)
    {
        $tokenData = DB::table('password_resets')
                        ->where('token', $token)->first();
        
        abort_if(is_null($tokenData), Response::HTTP_NOT_FOUND);

        return view('auth.password', [
            'email'     =>  $tokenData->email
        ]);
    }
}