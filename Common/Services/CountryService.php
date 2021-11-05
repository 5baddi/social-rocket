<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Common\Services;

use BADDIServices\SocialRocket\Common\Managers\CountryManager;
use Illuminate\Support\Str;
use PragmaRX\Countries\Package\Support\Collection;

class CountryService extends Service
{
    public function __construct(
        private CountryManager $countryManager
    ) {
        parent::__construct();
    }

    public function findByIsoCode(string $code): Collection
    {
        return $this->countryManager->findByIsoCode($code);
    }

    public function getLocaleByCountry(string $code): ?string
    {
        $country = $this->findByIsoCode($code);
        if (! $country instanceof Collection) {
            return null;
        }

        $locales = $country->languages->getItems();
        $firstLocale = array_key_first($locales);

        return Str::substr($firstLocale, 0, 2);
    }
}
