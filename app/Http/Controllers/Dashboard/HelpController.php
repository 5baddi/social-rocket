<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class HelpController extends Controller
{
    public function __invoke()
    {
        if (!config('clnkgo.help_url')) {
            return redirect()->route('landing');
        }
        
        return redirect(config('clnkgo.help_url'));
    }
}