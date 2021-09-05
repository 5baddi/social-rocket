<?php


/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Blog\Controllers;

use Wink\WinkPost;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = WinkPost::live()
            ->orderBy('publish_date', 'DESC')
            ->paginate(10);

        dd($posts);
    }
}