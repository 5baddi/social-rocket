<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Managers;

use BADDIServices\SocialRocket\Common\Managers\Cache\CacheManager;
use BADDIServices\SocialRocket\Common\Repositories\CountryRepository;
use PragmaRX\Countries\Package\Support\Collection;

class CountryManager extends CacheManager
{
    protected const CACHE_KEY = "countries:%s";

    public function __construct(
        private CountryRepository $countryRepository
    ) {
        parent::__construct();
    }

    public function findByIsoCode(string $code): Collection
    {
        $country = $this->get($code);
        if (!$country instanceof Collection) {
            $country = $this->countryRepository->findByIsoCode($code);

            $this->forever($code, $country);
        }

        return $country;
    }
}
