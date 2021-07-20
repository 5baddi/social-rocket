<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers\Dashboard\Customize;

use BADDIServices\ClnkGO\Http\Controllers\DashboardController;

class CustomizeController extends DashboardController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __invoke()
    {
        return view('dashboard.customize.index', [
            'title'                 =>  'Customize',
            'setting'               =>  $this->setting
        ]);
    }
}