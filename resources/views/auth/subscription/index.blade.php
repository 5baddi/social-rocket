
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }} &mdash; Choose a plan</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.mini.png') }}"/>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>
    </head>
    <body>
        <header>
            <div class="content-header">
                <a href="{{ localeRoute('dashboard') }}" class="logo-header"><img src="{{ asset('assets/img/logo.svg') }}" alt=""></a>
            </div>
        </header>

        <section id="pricing">
            <div class="container">
                <div class="row row-pricing">
                    <div class="col-content-pricing col-lg-9">
                        <h2 class="title2">{{ !$currentPack ? 'Choose A Plan To Start Your 7 Day Trial' : 'Upgrade your plan' }}</h2>
                        <div class="text-center">
                            @php
                                if (Session::has('alert')) {
                                    $alert = Session::get('alert');
                                }
                            @endphp
                            @if(isset($alert) && $alert->type == 'error')
                            <p class="invalid-feedback" style="display: block;">{{ $alert->message }}</p>
                            @endif
                        </div>
                        <div class="list-plans-pricing" id="monthly">
                            @foreach ($packs as $pack)
                            <div class="item-plan">
                                <h3 class="title-item-plan">{{ ucwords($pack->name) }} @if($pack->is_popular)<span style="display: none;">Most Popular</span>@endif</h3>
                                <div class="box-price-item-plan">
                                    <h4 class="title-price-item-plan">{{ $pack->isFixedPrice() ? $pack->symbol : '' }}{{ $pack->price }}{{ !$pack->isFixedPrice() ? '%' : '' }}</h4>
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
                                <div class="box-btn-item-plan @if($currentPack && $currentPack->id === $pack->id) current-plan @endif">
                                    <a href="{{ ($currentPack && $currentPack->id === $pack->id) ? localeRoute('dashboard') : localeRoute('subscription.pack.billing', ['pack' => $pack->id]) }}" class="btn-item-plan btn-design1">{{ $currentPack && $currentPack->id === $pack->id ? 'Current Plan' : (!$currentPack ? 'Start Free Trial' : 'Choose ' . ucwords($pack->name)) }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if (!$currentPack)
                        <div class="text-center">
                            <a href="{{ localeRoute('subscription.cancel') }}" onclick="return confirm('Are you sure you want to delete your account?')">Delete your account!</a>
                        </div>
                        @endif
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
