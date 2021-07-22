<!DOCTYPE html>
<!--
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>{{ config('app.name') }} &mdash; @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.mini.png') }}"/>
    <!-- CSS files -->
    <link href="{{ asset('assets/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/tabler-flags.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/tabler-payments.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/daterangepicker.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/baddi.services.css') }}" rel="stylesheet"/>
  </head>
  <body class="antialiased">
    <div class="wrapper">
      @include('partials.dashboard.menu')
      <div class="page-wrapper">
        @include('partials.dashboard.breadcrumb')
        <div class="page-body mt-4">
          <div class="container-xl">
            @include('partials.dashboard.alert')

            @yield('content')
          </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
          <div class="container">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">&nbsp;</div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; {{ date('Y') }} All rights reserved
                  </li>
                  <li class="list-inline-item">
                    <a href="{{ url('/') }}" class="link-secondary" rel="noopener">v1.0.0</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    @yield('scripts')
    <script src="{{ asset('assets/js/tabler.min.js') }}"></script>
    @if (config('clnkgo.zendesk_key'))
    <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key={{ config('clnkgo.zendesk_key') }}"></script>
    @endif
    <script type="text/javascript">
    @yield('script')
    </script>
  </body>
</html>