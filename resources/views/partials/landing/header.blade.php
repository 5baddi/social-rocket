<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="author" content="Baddi Services"/>
        <title>{{ config('app.name') }}</title>

        <!-- Start FAVICON -->
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('assets/img/favico/apple-touch-icon-57x57.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('assets/img/favico/apple-touch-icon-114x114.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('assets/img/favico/apple-touch-icon-72x72.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('assets/img/favico/apple-touch-icon-144x144.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('assets/img/favico/apple-touch-icon-60x60.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('assets/img/favico/apple-touch-icon-120x120.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('assets/img/favico/apple-touch-icon-76x76.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('assets/img/favico/apple-touch-icon-152x152.png') }}" />
        <link rel="icon" type="image/png" href="{{ asset('assets/img/favico/favicon-196x196.png') }}" sizes="196x196" />
        <link rel="icon" type="image/png" href="{{ asset('assets/img/favico/favicon-96x96.png') }}" sizes="96x96" />
        <link rel="icon" type="image/png" href="{{ asset('assets/img/favico/favicon-32x32.png') }}" sizes="32x32" />
        <link rel="icon" type="image/png" href="{{ asset('assets/img/favico/favicon-16x16.png') }}" sizes="16x16" />
        <link rel="icon" type="image/png" href="{{ asset('assets/img/favico/favicon-128.png') }}" sizes="128x128" />
        <meta name="application-name" content="&nbsp;"/>
        <meta name="msapplication-TileColor" content="#FFFFFF" />
        <meta name="msapplication-TileImage" content="{{ asset('assets/img/favico/mstile-144x144.png') }}" />
        <meta name="msapplication-square70x70logo" content="{{ asset('assets/img/favico/mstile-70x70.png') }}" />
        <meta name="msapplication-square150x150logo" content="{{ asset('assets/img/favico/mstile-150x150.png') }}" />
        <meta name="msapplication-wide310x150logo" content="{{ asset('assets/img/favico/mstile-310x150.png') }}" />
        <meta name="msapplication-square310x310logo" content="{{ asset('assets/img/favico/mstile-310x310.png') }}" />
        <!-- End FAVICON -->

        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/baddiservices.main.css') }}"/>

        <!-- Start of Async Drift Code -->
        <script>
            "use strict";

            !function() {
            var t = window.driftt = window.drift = window.driftt || [];
            if (!t.init) {
                if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
                t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ],
                t.factory = function(e) {
                return function() {
                    var n = Array.prototype.slice.call(arguments);
                    return n.unshift(e), t.push(n), t;
                };
                }, t.methods.forEach(function(e) {
                t[e] = t.factory(e);
                }), t.load = function(t) {
                var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
                o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
                var i = document.getElementsByTagName("script")[0];
                i.parentNode.insertBefore(o, i);
                };
            }
            }();
            drift.SNIPPET_VERSION = '0.3.1';
            drift.load('e9skwmkr8hwu');
        </script>
        <!-- End of Async Drift Code -->

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-DGDWP8P20K"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-DGDWP8P20K');
        </script>
    </head>

    <body>
        <!-- Preloader -->
        <div class="preloader">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img  src="{{ asset('assets/img/logo.svg') }}" id="navbar-logo">
                </a>
                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mt-4 mt-lg-0 ml-auto">
                        @if (request()->routeIs('landing'))
                        <li class="nav-item ">
                            <a class="nav-link" href="#features">@lang('landing.features')</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#pricing">Pricing</a>
                        </li>
                        @endif
                        <li class="nav-item ">
                            <a class="nav-link" href="#">Blog</a>
                        </li>
                    </ul>
                    @guest
                    <a class="navbar-btn btn btn-sm btn-primary d-none d-lg-inline-block ml-3" href="{{ route('signin') }}">
                        Sign in
                    </a>
                    @endguest
                    @auth
                    <a class="navbar-btn btn btn-sm btn-primary d-none d-lg-inline-block ml-3" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                    @endauth
                    <div class="d-lg-none text-center">
                        @guest
                        <a href="{{ route('signin') }}" class="btn btn-block btn-sm btn-warning">
                            Sign in
                        </a>
                        @endguest
                        @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-block btn-sm btn-warning">
                            Dashboard
                        </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
