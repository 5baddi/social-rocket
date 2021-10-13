<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\Shopify\Entities;

use BADDIServices\SocialRocket\Models\OAuth as OAuthModel;

class OAuth extends OAuthModel
{
    public function getAccessToken(): ?string
    {
        return null;
    }
}
