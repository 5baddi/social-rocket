<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Repositories;

use PragmaRX\Countries\Package\Countries;
use PragmaRX\Countries\Package\Support\Collection;

class CountryRepository
{
    public function __construct(
        private Countries $countries
    ) {}

    public function findByIsoCode(string $isoCode): Collection
    {
        return $this->countries
            ->where('cca2', $isoCode)
            ->first();
    }
}
