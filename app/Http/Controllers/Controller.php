<?php

namespace App\Http\Controllers;

use BADDIServices\ClnkGO\Logger;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var Logger */
    protected $logger;

    public function __construct()
    {
        $this->logger = app(Logger::class);
    }
}
