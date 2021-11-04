<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    'shop'              =>  [
        'is_linked'     => 'Shop is already connect! please try to sign in.',
        'url_invalid'   => 'Shop URL is invalid',
        'connect_error' => sprintf('An error occurred while connecting the shop with %s app', config('app.name'))
    ]
];
