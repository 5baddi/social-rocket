
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} &mdash; @yield('title')</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.mini.png') }}"/>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>

        <meta name="description" content="Connect your Shopify store to Social Snowball and start converting your customers into affiliates instantly (literally).">
    </head>
    <body class="body-login">
        <header>
            <div class="container content-header">
                <a href="{{ url('/') }}" class="logo-header logo-header-login">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="{{ config('app.name') }}"/>
                </a>
            </div>
        </header>
        <div class="container-fluid container-fluid-body">
            <div class="row">
                <div class="col-lg-7 col-box-left-login">
                    <div class="box-left-login">
                        <div class="box-text-left-login"></div>
                        <img src="{{ asset('img/vector.png') }}" class="img-box-left-login"/>
                    </div>
                </div>
                <div class="col-lg-5 col-box-right-login">
                    <div class="box-right-login box-right-login-conect-store">
                        @yield('form')
                    </div>
                </div>
            </div>
        </div>
        
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>