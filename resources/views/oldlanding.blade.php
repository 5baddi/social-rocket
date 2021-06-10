
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>{{ config('app.name') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.mini.png') }}"/>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/aos.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/landing.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/home.responsive.css') }}"/>
    </head>
    <body>
        <header>
            <div class="content-header">
                <a href="{{ url('/') }}" class="logo-header">
                    <img src="{{ asset('assets/img/logo.png') }}"/>
                </a>
                <div class="overlay-menu"></div>
                <div class="box-links-header">
                    <ul class="links-header">
                        <li><a href="#how-it-works" class="link-header">How it works</a></li>
                        <li><a href="#pricing" class="link-header">Pricing</a></li>
                        <li><a href="#faqs" class="link-header">FAQ</a></li>
                        <li><a href="{{ route('guide') }}" class="link-header" target="_blank">Blog</a></li>
                        @if(!auth()->check())
                        <li><a href="{{ route('signin') }}" class="link-sign-in btn-design1">Sign In</a></li>
                        @else
                        <li><a href="{{ route('dashboard') }}" class="link-sign-in btn-design1">Dashboard</a></li>
                        @endif
                    </ul>
                </div>
                <button class="btn-mobile">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </header>
        <div class="preview-load-page"></div>

        <section id="banner">
            <img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/home/img/img-banner.png" alt="" class="bg-banner">
            <div class="container container-banner">
                <div class="row row-banner">
                    <div class="col-content-banner col-lg-6">
                        <h1 class="title1" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="1500">We convert all of your customers into motivated affiliates</h1>
                        <div class="box-text1" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="1500">
                            <p>Our custom thank you page + many other included features harmoniously convert your customers and store visitors into affiliates, working around the clock to bring you new sales.</p>
                        </div>
                        <div data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="300">
                            <a href="{{ route('connect') }}" class="btn-design1">Start Free Trial</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="how-it-works">
            <div class="container-fluid">
                <h6 class="small-title1" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">How it works</h6>
                <h1 class="title1" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">Not just another <br>affiliate marketing app</h1>
            </div>
        </section>

        <section class="section-custom">
            <div class="container">
                <div class="row row-section-custom">
                    <div class="col-lg-6 col-text-section-custom">
                        <h1 class="title1" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">Customer buys <br>a product</h1>
                        <div class="box-text1" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">
                            <p>When a new customer purchases from your store,
                                they are automatically created an affiliate account
                                and given materials to promote their custom
                                discount code right from the thank you page.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-img-section-custom">
                        <img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/home/img/section1.png" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="section-custom">
            <div class="container">
                <div class="row row-section-custom row-section-custom-invert">
                    <div class="col-lg-7 col-img-section-custom">
                        <img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/home/img/seccion2-1.png" alt="">
                    </div>
                    <div class="col-lg-5 col-text-section-custom">
                        <h1 class="title1" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">Customer turns <br>into affiliate</h1>
                        <div class="box-text1">
                            <p data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">Your newly turned affiliate will receive an
                                email to log into their account and collect
                                their funds immediately after they get their
                                first referral purchase.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-custom">
            <div class="container">
                <div class="row row-section-custom">
                    <div class="col-lg-6 col-text-section-custom">
                        <h1 class="title1" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">Affiliate brings <br>more affiliates</h1>
                        <div class="box-text1" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">
                            <p>The customers referred from your affiliates also
                                become affiliates and share their codes, creating a
                                rapidly expanding network of micro influencers all
                                over the world working hard to bring you new
                                customers!</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-img-section-custom">
                        <img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/home/img/section3.png" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="section-custom" id="affiliate-management">
            <div class="container">
                <div class="row row-section-custom row-section-custom-invert">
                    <div class="col-lg-6 col-img-section-custom">
                        <img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/home/img/img-afillate.png" alt="">
                    </div>
                    <div class="col-lg-6 col-text-section-custom">
                        <h1 class="title1" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">Affiliate management <br>just got a whole lot easier</h1>
                        <div class="box-text1">
                            <p data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">With a wide selection of payout solutions and an
                                impressively simple payout experience, managing
                                your affiliates has never been so effortless.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="pricing">
            <div class="container">
                <div class="row row-pricing">
                    <div class="col-content-pricing col-lg-9">
                        <h6 class="title-small" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">Pricing</h6>
                        <h2 class="title2 mb-0" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">Our Plans</h2>
                        <div class="list-plans-pricing" id="monthly">
                            @foreach ($packs as $pack)
                            <div class="item-plan">
                                <h3 class="title-item-plan">{{ ucwords($pack->name) }} @if($pack->is_popular)<span>Most Popular</span>@endif</h3>
                                <div class="box-price-item-plan">
                                    <h4 class="title-price-item-plan">{{ $pack->isFixedPrice() ? $pack->symbol : '' }}{{ $pack->price }}{{ !$pack->isFixedPrice() ? '%' : '' }}</h4>
                                    <div class="text-price-item-plan">
                                        <p>/ {{ $pack->isFixedPrice() ? 'per month' : 'of revenue share' }}</p>
                                    </div>
                                </div>
                                {{-- <p class="text-discount-item-plan">+ 10% of revenue generated by {{ config('app.name') }}</p> --}}
                                <div class="separate-line"></div>
                                <ul class="list-benefics-item-plan">
                                    @foreach ($pack->features as $feature)
                                    <li @if(!$feature['enabled'])class="uncheck"@endif>{{ ucwords($feature['name']) }}</li>
                                    @endforeach
                                </ul>
                                <div class="box-btn-item-plan">
                                    <a href="{{ route('signin') }}" class="btn-item-plan btn-design1">Start Free Trial</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="faqs">
            <div class="container">
                <div class="row row-faqs">
                    <div class="col-lg-9 col-content-faqs">
                        <h6 class="title-small" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">FAQ</h6>
                        <h2 class="title2" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">Have more questions?</h2>
                        <div class="items-faqs" data-aos="fade-in" data-aos-easing="linear" data-aos-duration="500" data-aos-delay="100">
                            <div class="item-faq">
                                <button class="btn-item-faq">What is the “{{ config('app.name') }} effect”? <img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/home/img/arrow-down.svg" alt=""></button>
                                <div class="content-item-faq">
                                    <p>
                                        The {{ config('app.name') }} effect is a tangible application of the “Snowball Effect”, defined by Merriam-Webster as: “a situation in which one action or event causes many other similar actions or events”. The {{ config('app.name') }} effect involves the event of acquiring a new customer as a catalyst to the acquisition of many new customers. This is accomplished by our custom thank you page, as well as many other included features. To better explain just how powerful the {{ config('app.name') }} effect is, let's compare and contrast an example store with and without {{ config('app.name') }} installed:
                                        <br>
                                        &nbsp; &nbsp; &nbsp; &nbsp;i. You run a facebook ad and get a sale. The customer is happy with the product and brand experience, yet has no way to share their positive experience or help your brand. You have an affiliate sign up form on your website, yet only about 1 in 50 customers sign up. The few affiliates you do have do not know how to effectively bring you more customers, and give up promoting your products after a couple weeks.
                                        <br>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;1. Ad spend to acquire the customer: 10$
                                        <br>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;2. Customer’s lifetime value: 40$
                                        <br>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;3. Affiliate revenue generated from customer: 0$
                                        <br>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4. Profit: 30$
                                        <br>
                                        &nbsp; &nbsp; &nbsp; &nbsp;ii. You run a facebook ad and get a sale. Without any additional action, the customer is created an affiliate account and is given a discount code to share across social media to their friends, family, and followers, with the incentive that they will get paid commision off of the sales they generate. This new affiliate is provided with practical, easy to consume content that teaches them how to be the most effective ambassador they can be. The affiliate shares their code and gets 3 new sales for your store. These 3 customers are also automatically created affiliate accounts, and bring you in a total of 12 new customers, who likewise bring in even more customers and your network of affiliates exponentially grows. You only paid to acquire that first customer, yet now you have a massive network of customers growing on autopilot. This is what’s called the {{ config('app.name') }} effect, and it will make your marketing dollars go significantly further than ever before.
                                        <br>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;1. Ad spend to acquire the customer: 10$
                                        <br>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;2. Customer’s lifetime value: 40$
                                        <br>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;3. Affiliate revenue generated directly from customer: 120$
                                        <br>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;4. Affiliate revenue generated from the {{ config('app.name') }} effect: Unlimited
                                        <br>
                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;5. Profit: Unlimited
                                    </p>
                                </div>
                            </div>
                            <div class="item-faq">
                                <button class="btn-item-faq">Why is {{ config('app.name') }} more effective than other affiliate apps? <img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/home/img/arrow-down.svg" alt=""></button>
                                <div class="content-item-faq">
                                    <p>Unlike other affiliate marketing apps that leave almost every happy customer without a way to share their love for your brand, {{ config('app.name') }} will convert all of your customers, and even a big percentage of non-buying store visitors, into motivated affiliates. On top of that, we equip your affiliates with straightforward, easy to consume content that teaches them how to be the best affiliate possible.</p>
                                </div>
                            </div>
                            <div class="item-faq">
                                <button class="btn-item-faq">What if I already use a different affiliate marketing app? <img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/home/img/arrow-down.svg" alt=""></button>
                                <div class="content-item-faq">
                                    <p>We understand you may already be using another affiliate marketing program. For this reason, we have created a seamless and easy process to transfer all of your affiliates from your current affiliate marketing app into {{ config('app.name') }}.  For more detailed instructions on how to import existing affiliates, click here.</p>
                                </div>
                            </div>
                            <div class="item-faq">
                                <button class="btn-item-faq">Can I still acquire affiliates through a traditional sign-up form?  <img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/home/img/arrow-down.svg" alt=""></button>
                                <div class="content-item-faq">
                                    <p>Absolutely! Beyond our thank you page sharing feature we provide our merchants with an affiliate sign-up form they can add to their website. Even better, our merchants can activate an on-site pop-up for browsing visitors that will transport visitors directly to the affiliate sign-up form. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer>
            <img src="{{ asset('assets/img/bg-footer.svg') }}" class="bg-footer"/>
            <img src="{{ asset('assets/img/bg-footer-mobile.svg') }}" class="bg-footer bg-footer-mobile"/>
            <div class="content-footer">
                <a href="{{ url('/') }}" class="logo-footer">
                    <img src="{{ asset('assets/img/logo-white.mini.jpg') }}" style="max-width: 48px;"/>
                </a>
                <div class="break-point-footer"></div>
                <ul class="links-booter">
                    <li><a href="{{ config('rocket.help_url') }}">Contact Us</a></li>
                    {{-- <li><a href="#">FAQ</a></li> --}}
                    {{-- <li><a href="https://socialsnowball.io/privacy">Privacy</a></li> --}}
                    {{-- <li><a href="https://socialsnowball.io/terms">Terms Of Use</a></li> --}}
                    {{-- <li><a href="#">Pricing</a></li> --}}
                </ul>
                <ul class="links-rd">
                    <li>
                        <a href="https://facebook.com/{{ $appSettings->facebook_username }}">
                            <img src="{{ asset('img/facebook.svg') }}"/>
                        </a>
                    </li>
                    <li>
                        <a href="https://instagram.com/{{ $appSettings->instagram_username }}">
                            <img src="{{ asset('img/instagram.svg') }}"/>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/{{ $appSettings->twitter_username }}">
                            <img src="{{ asset('img/twitter.svg') }}"/>
                        </a>
                    </li>
                </ul>
            </div>
        </footer>

        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/aos.js') }}"></script>
        <script src="{{ asset('js/home.main.js') }}"></script>
    </body>
</html>