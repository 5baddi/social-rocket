<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

if (! function_exists('localeRoute')) {
    function localeRoute(string $route, array $params = []): string
    {
        $locale = app()->getLocale();

        return route($route, array_merge($params, ['locale' => $locale]));
    }
}
