<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Torann\GeoIP\GeoIP;

class IpLocatorService extends Service
{
    public function __construct(
        private GeoIP $geoIP
    )
    {
        parent::__construct();
    }

    public function getCountryFromIp(Request $request): ?string
    {
        $location = $this->geoIP->getLocation($request->getClientIp());

        return Arr::get($location, 'iso_code');
    }
}
