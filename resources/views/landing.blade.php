@include('partials.landing.header')
        <!-- Main content -->
        <section class="slice py-7">
            <div class="container">
                <div class="row row-grid align-items-center">
                    <div class="col-12 col-md-5 col-lg-6 order-md-2 text-center">
                        <!-- Image -->
                        <figure class="w-100">
                            <img alt="Dashboard" src="{{ asset('assets/img/dashboard.png') }}" class="img-fluid rounded mw-md-120"/>
                        </figure>
                    </div>
                    <div class="col-12 col-md-7 col-lg-6 order-md-1 pr-md-5">
                        <!-- Heading -->
                        <h1 class="display-4 text-center text-md-left mb-3">
                            Let's bring more affiliates for <br/><strong class="text-primary">More sales</strong>
                        </h1>
                        <!-- Text -->
                        <p class="lead text-center text-md-left text-muted">
                            Our app offers you easy tools to shape your affiliate program and win more and 
more affiliates. With {{ config('app.name') }}, you can step back and see your newest 
customers bring in more shoppers. And this cycle continues. 
                        </p>
                        <!-- Buttons -->
                        <div class="text-center text-md-left mt-5">
                            <a href="{{ route('connect') }}" class="btn btn-primary btn-icon">
                                <span class="btn-inner--text">Try {{ config('app.name') }} Now!</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg bg-section-dark pt-5 pt-lg-8">
            <!-- SVG separator -->
            <div class="shape-container shape-line shape-position-top shape-orientation-inverse">
                <svg width="2560px" height="100px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve" class="">
                    <polygon points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
            <!-- Container -->
            <div class="container position-relative zindex-100">
                <div class="col">
                    <div class="row justify-content-center">
                        <div class="col-md-10 text-center">
                            <div class="mt-4 mb-6">
                                <h2 class="h1 text-white">
                                    Why is {{ config('app.name') }} Better?
                                </h2>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="icon icon-shape bg-white text-white icon-sm rounded-circle mr-3">
                                                <i class="fas fa-file-invoice"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6 mb-0 text-white">No restriction on the number of affiliates, watch your revenue skyrocket with limitless affiliates.</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="icon icon-shape bg-white text-white icon-sm rounded-circle mr-3">
                                                <i class="fas fa-file-invoice"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6 mb-0 text-white">Offer up to 6 Payout methods to your affiliates for speedy withdrawal.</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="icon icon-shape bg-white text-white icon-sm rounded-circle mr-3">
                                                <i class="fas fa-file-invoice"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6 mb-0 text-white">Enjoy our Live chat support whenever you need us.</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled mb-0">
                                <li class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="icon icon-shape bg-white text-white icon-sm rounded-circle mr-3">
                                                <i class="fas fa-file-invoice"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6 mb-0 text-white">Customize the entire affiliate program with easy tools.</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="icon icon-shape bg-white text-white icon-sm rounded-circle mr-3">
                                                <i class="fas fa-file-invoice"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6 mb-0 text-white">Track and analyze progress with a friendly and clean {{ config('app.name') }} dashboard.</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg">
            <div class="container">
                <div class="row mb-2 justify-content-center text-center">
                    <div class="col" id="how-it-work">
                        <h2>How {{ config('app.name') }} Becomes a Gamechanger? </h2>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body pb-5">
                                <div class="pt-4 pb-5">
                                    <img src="{{ asset('assets/img/people.svg') }}" class="img-fluid img-center" style="height:150px"/>
                                </div>
                                <h5 class="h4 lh-130 mb-3">Design the Best Affiliate Program Effortlessly</h5>
                                <p class="text-muted mb-0">Convert your customers and visitors into affiliates with our most innovative tools. 
                                    Simply copy our given code and paste it on your website to display an affiliate 
                                    form. This will attract more visitors to become affiliates and earn you some extra 
                                    cash. You can also set up an email flow for your shoppers after they purchase 
                                    something. These automated mails will allow you to stay connected with your 
                                    customers. We recommend inviting your shoppers to become your affiliate using 
                                    the 'Thank You' page. You can easily tailor the text on the 'Thank You' page and win 
                                    more affiliates.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body pb-5">
                                <div class="pt-4 pb-5">
                                    <img src="{{ asset('assets/img/dashboard.svg') }}" class="img-fluid img-center" style="height:150px"/>
                                </div>
                                <h5 class="h4 lh-130 mb-3">Offer Something Interesting for Your Affiliates</h5>
                                <p class="text-muted mb-0">{{ config('app.name') }} is not just offering some discount codes. Your visitors and customers 
                                    can make real money from you. They can use dashboards to track their sales. On 
                                    top of that, you can offer up to 6 payout methods that make their money-making 
                                    process much more manageable. That means, by doing the bare minimum, you 
                                    can run an extensive network of affiliates.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body pb-5">
                                <div class="pt-4 pb-5">
                                    <img src="{{ asset('assets/img/manage.svg') }}" class="img-fluid img-center" style="height:150px"/>
                                </div>
                                <h5 class="h4 lh-130 mb-3">Manage Unlimited Affiliates Without a Hitch</h5>
                                <p class="text-muted mb-0">{{ config('app.name') }} lets you create automatic affiliate codes and links that your affiliates 
                                    can share and earn with every successful purchase. {{ config('app.name') }} enables you to 
                                    create a bunch of affiliate soldiers and maintain this program effortlessly. You can 
                                    use our dashboard to see the best-selling products, your top affiliates and track 
                                    revenue and commissions.
                                    </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body pb-5">
                                <div class="pt-4 pb-5">
                                    <img src="{{ asset('assets/img/settings.svg') }}" class="img-fluid img-center" style="height:150px"/>
                                </div>
                                <h5 class="h4 lh-130 mb-3">Set Your Rates & Tailor Settings</h5>
                                <p class="text-muted mb-0">With our super accessible settings, you can customize your commissions and apply 
                                    them automatically. Turn on the Notifications, if you wish to stay updated 
                                    whenever a new affiliate joins your program, or each time you manage a sale. 
                                    {{ config('app.name') }} helps you build your affiliate network, set commissions, manage 
                                    payouts and monitor revenues. With us, you can get more sales by turning your 
                                    visitors and customers into affiliates. And this does not require a whole lot of effort 
                                    or time from you. 
                                    </p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="py-4">
                    <div class="row row-grid justify-content-between align-items-center">
                        <div class="col-lg-5 order-lg-2">
                            <h5 class="h3">Design the Best Affiliate Program Effortlessly</h5>
                            <p class="lead my-4">
                                Convert your customers and visitors into affiliates with our most innovative tools. 
Simply copy our given code and paste it on your website to display an affiliate 
form. This will attract more visitors to become affiliates and earn you some extra 
cash. You can also set up an email flow for your shoppers after they purchase 
something. These automated mails will allow you to stay connected with your 
customers. We recommend inviting your shoppers to become your affiliate using 
the 'Thank You' page. You can easily tailor the text on the 'Thank You' page and win 
more affiliates. 
                            </p>
                        </div>
                        <div class="col-lg-6 order-lg-1">
                            <div class="card mb-0 mr-lg-5">
                                <div class="card-body p-2">
                                    <img  src="{{ asset('assets/img/dashboard.png') }}" class="img-fluid shadow rounded"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>
        <section class="slice slice-lg bg-section-secondary">
            <div class="container text-center">
                <div class="row justify-content-center mb-6" id="pricing">
                    <div class="col-lg-8">
                        <!-- Title -->
                        <h2 class="h1 strong-600">
                            Our Plans
                        </h2>
                        <!-- Text -->
                        <p class="text-muted">
                            Pricing
                        </p>
                    </div>
                </div>
                <!-- Pricing -->
                <div class="row justify-content-center">
                    @foreach ($packs as $pack)
                    <div class="col-lg-4 col-md">
                        <div class="card card-pricing @if($pack->is_popular)bg-dark @endif text-center px-3 hover-scale-110">
                            <div class="card-header border-0 delimiter-bottom">
                                <h5 class="@if($pack->is_popular)text-white @else text-muted @endif">{{ ucwords($pack->name) }}</h5>
                                <div class="h1 text-center mb-0 @if($pack->is_popular)text-white @endif">
                                    {{ $pack->isFixedPrice() ? $pack->symbol : '' }}<span class="price font-weight-bolder">{{ $pack->price }}</span>{{ !$pack->isFixedPrice() ? '%' : '' }} 
                                    <p class="text-sm">{{ $pack->isFixedPrice() ? 'per month' : 'of revenue share' }}</p>
                                </div>
                                <hr/>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled text-sm mb-4 @if($pack->is_popular)text-white @endif">
                                    @foreach ($pack->features as $feature)
                                    <li @if(!$feature['enabled'])class="uncheck"@endif>{{ ucwords($feature['name']) }}</li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('connect') }}" class="btn btn-sm btn-warning hover-translate-y-n3 hover-shadow-lg mb-3">Start Free Trial</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
@include('partials.landing.footer')