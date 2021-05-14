
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} &mdash; Choose a plan</title>
        <link rel="icon" type="image/png" href="{{ asset('img/mini-logo.png') }}"/>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>
    </head>
    <body>
        <header>
            <div class="content-header">
                <a href="{{ route('dashboard') }}" class="logo-header"><img src="{{ asset('img/logo.png') }}" alt=""></a>
            </div>
        </header>

        <section id="pricing">
            <div class="container">
                <div class="row row-pricing">
                    <div class="col-content-pricing col-lg-9">
                        <h2 class="title2">Chose A Plan To Start Your 7 Day Trial</h2>
                        <div class="list-plans-pricing" id="monthly">
                            @foreach ($packs as $pack)
                            <div class="item-plan">
                                <h3 class="title-item-plan">{{ ucwords($pack->name) }} @if($pack->is_popular)<span>Most Popular</span>@endif</h3>
                                <div class="box-price-item-plan">
                                    <h4 class="title-price-item-plan">{{ $pack->isFixedPrice() ? $pack->currency_symbol : '' }}{{ $pack->price }}{{ !$pack->isFixedPrice() ? '%' : '' }}</h4>
                                    <div class="text-price-item-plan">
                                        <p>/ {{ $pack->isFixedPrice() ? 'per month' : 'of revenue share' }}</p>
                                    </div>
                                </div>
                                {{-- <p class="text-discount-item-plan">+ 10% of revenue generated by Social Snowball</p> --}}
                                <div class="separate-line"></div>
                                <ul class="list-benefics-item-plan">
                                    @foreach ($pack->features as $feature)
                                    <li @if(!$feature['enabled'])class="uncheck"@endif>{{ ucwords($feature['name']) }}</li>
                                    @endforeach
                                </ul>
                                <div class="box-btn-item-plan @if($currentPack->id === $pack->id) current-plan @endif">
                                    <a href="{{ $currentPack->id === $pack->id ? route('dashboard') : route('dashboard.pack.billing', ['pack' => $pack->id]) }}" class="btn-item-plan btn-design1">{{ $currentPack->id === $pack->id ? 'Current Plan' : 'Start Free Trial' }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>