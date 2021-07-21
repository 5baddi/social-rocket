<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Controllers;

use App\Http\Controllers\Controller;
use BADDIServices\ClnkGO\Services\PackService;

class LandingPageController extends Controller
{
    /** @var PackService */
    private $packService;

    public function __construct(PackService $packService)
    {
        parent::__construct();

        $this->packService = $packService;
    }

    public function __invoke()
    {
        return view('landing', [
            'packs'         =>  $this->packService->all()
        ]);
    }

    public function privacy()
    {
        return view('privacy');
    }
}