<?php


/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Blog\Controllers;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /** @var string */
    protected $baseView = 'blog';

    protected function baseData(): array
    {
        return array_merge(
            parent::baseData(),
            [

            ]
        );
    }
}
