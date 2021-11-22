<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Middleware;

use BADDIServices\SocialRocket\App;
use BADDIServices\SocialRocket\Common\Logger;
use BADDIServices\SocialRocket\Common\LogParametersList;
use BADDIServices\SocialRocket\Common\Services\CountryService;
use BADDIServices\SocialRocket\Common\Services\IpLocatorService;
use BADDIServices\SocialRocket\FeatureList;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class LanguageMIddleware
{
    public function __construct(
        private Logger $logger,
        private SessionManager $sessionManager,
        private IpLocatorService $ipLocatorService,
        private CountryService $countryService
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $locale = $this->getLocaleFromRequest($request);
            app()->setLocale($locale);

            $hasSameLocale = $this->sessionManager->get('locale') === $locale;
            $notIsHomePage = $request->getPathInfo() !== '/' && $request->segment(1) !== null;
            if ($hasSameLocale && $notIsHomePage) {
                return $next($request);
            }

            $this->updateLocale($locale);

            return $this->redirectWithLocale($request);
        } catch (\Throwable $e) {
            $this->logger->trace(
                'an occurred error during fetching user locale',
                [
                    LogParametersList::FEATURE      => FeatureList::MULTI_LANGUAGE,
                    LogParametersList::PAYLOAD      => [
                        'uri'                       => optional($request)->getUri,
                        'locale'                    => optional($locale),
                        'ip'                        => optional($request)->getClientIp(),
                        'session.locale'            => optional($this->sessionManager)->get('locale')
                    ]
                ],
                $e
            );

            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function getLocaleFromRequest(Request $request): string
    {
        $locale = $request->segment(1);
        if ($request->query->has('lang') || $request->headers->has('x-preferred-locale')) {
            $locale = $request->query('lang', Str::substr($request->header('x-preferred-locale'), 0, 2));
        }

        $countryFromIp = $this->ipLocatorService->getCountryFromIp($request);
        if ($locale === null && $countryFromIp !== null) {
            $locale = $this->countryService->getLocaleByCountry($countryFromIp);
        }

        return in_array($locale, App::SUPPORTED_LOCALES) ? $locale : App::DEFAULT_LOCALE;
    }

    private function updateLocale(string $locale): void
    {
        $this->sessionManager->put('locale', $locale);
    }

    /**
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    private function redirectWithLocale(Request $request)
    {
        $queryParams = $request->query();
        Arr::forget($queryParams, 'lang');
        $routeParams = array_merge($request->route()->parameters(), $queryParams);
        $targetUrl = localeRoute($request->route()->getName(), $routeParams);

        return redirect($targetUrl);
    }
}
