<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="author" content="Baddi Services"/>
        <title>{{ config('app.name') }}</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.mini.png') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/css/baddiservices.main.css') }}"/>
    </head>

    <body>
        <!-- Preloader -->
        <div class="preloader">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        {{-- <div class="modal fade" tabindex="-1" role="dialog" id="modal-cookies" data-backdrop="false" aria-labelledby="modal-cookies" aria-hidden="true">
            <div class="modal-dialog modal-dialog-aside left-4 right-4 bottom-4">
                <div class="modal-content bg-dark-dark">
                    <div class="modal-body">
                        <!-- Text -->
                        <p class="text-sm text-white mb-3">
                            We use cookies so that our themes work for you. By using our website, you agree to our use of cookies.
                        </p>
                        <!-- Buttons -->
                        <a href="pages/utility/terms.html" class="btn btn-sm btn-white" target="_blank">Learn more</a>
                        <button type="button" class="btn btn-sm btn-primary mr-2" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="index.html">
                    <img alt="Image placeholder" src="{{ asset('assets/img/logo.png') }}" id="navbar-logo">
                </a>
                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mt-4 mt-lg-0 ml-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="#">How it works</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="#pricing">Pricing</a>
                        </li>
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
                            We convert all of your customers into <strong class="text-primary">motivated affiliates</strong>
                        </h1>
                        <!-- Text -->
                        <p class="lead text-center text-md-left text-muted">
                            Our custom thank you page + many other included features harmoniously convert your customers and store visitors into affiliates, working around the clock to bring you new sales.
                        </p>
                        <!-- Buttons -->
                        <div class="text-center text-md-left mt-5">
                            <a href="{{ route('connect') }}" class="btn btn-primary btn-icon">
                                <span class="btn-inner--text">Start Free Trial</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- <section class="slice slice-lg pt-lg-6 pb-0 pb-lg-6 bg-section-secondary">
            <div class="container">
                <!-- Title -->
                <!-- Section title -->
                <div class="row mb-5 justify-content-center text-center">
                    <div class="col-lg-6">
                        <span class="badge badge-soft-success badge-pill badge-lg">
                            Get started
                        </span>
                        <h2 class=" mt-4">Carefuly crafted components ready to use in your project</h2>
                        <div class="mt-2">
                            <p class="lead lh-180">Use Atomic Design to build components, sections and, then, pages.</p>
                        </div>
                    </div>
                </div>
                <!-- Card -->
                <div class="row mt-5">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body pb-5">
                                <div class="pt-4 pb-5">
                                    <img src="assets/img/svg/illustrations/illustration-5.svg" class="img-fluid img-center" style="height: 150px;" alt="Illustration" />
                                </div>
                                <h5 class="h4 lh-130 mb-3">Unleash you creativity</h5>
                                <p class="text-muted mb-0">Quick Website UI Kit (FREE) contains components and pages that are easy to customize and change.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body pb-5">
                                <div class="pt-4 pb-5">
                                    <img src="assets/img/svg/illustrations/illustration-6.svg" class="img-fluid img-center" style="height: 150px;" alt="Illustration" />
                                </div>
                                <h5 class="h4 lh-130 mb-3">Get more results</h5>
                                <p class="text-muted mb-0">Quick Website UI Kit (FREE) contains components and pages that are easy to customize and change.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body pb-5">
                                <div class="pt-4 pb-5">
                                    <img src="assets/img/svg/illustrations/illustration-7.svg" class="img-fluid img-center" style="height: 150px;" alt="Illustration" />
                                </div>
                                <h5 class="h4 lh-130 mb-3">Increase your audience</h5>
                                <p class="text-muted mb-0">Quick Website UI Kit (FREE) contains components and pages that are easy to customize and change.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg">
            <div class="container">
                <div class="py-6">
                    <div class="row row-grid justify-content-between align-items-center">
                        <div class="col-lg-5 order-lg-2">
                            <h5 class="h3">Need a quick admin panel for your website?</h5>
                            <p class="lead my-4">
                                With Quick you get components and examples, including tons of variables that will help you customize this theme with ease.
                            </p>
                            <ul class="list-unstyled mb-0">
                                <li class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="icon icon-shape bg-primary text-white icon-sm rounded-circle mr-3">
                                                <i class="fas fa-file-invoice"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6 mb-0">Perfect for modern startups</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="icon icon-shape bg-primary text-white icon-sm rounded-circle mr-3">
                                                <i class="fas fa-store-alt"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6 mb-0">Ready to be customized</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6 order-lg-1">
                            <div class="card mb-0 mr-lg-5">
                                <div class="card-body p-2">
                                    <img alt="Image placeholder" src="assets/img/theme/light/screen-1-1000x800.jpg" class="img-fluid shadow rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="py-6">
                    <div class="row row-grid justify-content-between align-items-center">
                        <div class="col-lg-5">
                            <h5 class="h3">A modern project management dashboard</h5>
                            <p class="lead my-4">
                                With Quick you get components and examples, including tons of variables that will help you customize this theme with ease.
                            </p>
                            <ul class="list-unstyled mb-0">
                                <li class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="icon icon-shape bg-primary text-white icon-sm rounded-circle mr-3">
                                                <i class="fas fa-file-invoice"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6 mb-0">Perfect for modern startups</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="icon icon-shape bg-primary text-white icon-sm rounded-circle mr-3">
                                                <i class="fas fa-store-alt"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6 mb-0">Ready to be customized</span>
                                        </div>
                                    </div>
                                </li>
                                <li class="py-2">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="icon icon-shape bg-primary text-white icon-sm rounded-circle mr-3">
                                                <i class="fas fa-store-alt"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <span class="h6 mb-0">Designed for every devices</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-0 ml-lg-5">
                                <div class="card-body p-2">
                                    <img alt="Image placeholder" src="assets/img/theme/light/screen-2-1000x800.jpg" class="img-fluid shadow rounded">
                                </div>
                            </div>
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
                                    Are you ready to grow faster?
                                </h2>
                                <h4 class="text-white mt-3">Create your own experience</h4>
                                <!-- Play button -->
                                <a href="#" class="btn btn-primary btn-icon mt-4">Learn more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice pt-0">
            <div class="container position-relative zindex-100">
                <div class="row">
                    <div class="col-xl-4 col-sm-6 mt-n7">
                        <div class="card">
                            <div class="d-flex p-5">
                                <div>
                                    <span class="badge badge-warning badge-pill">New</span>
                                </div>
                                <div class="pl-4">
                                    <h5 class="lh-130">Listen to the nature</h5>
                                    <p class="text-muted mb-0">
                                        Design made simple with a clean and smart HTML markup.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6 mt-sm-n7">
                        <div class="card">
                            <div class="d-flex p-5">
                                <div>
                                    <span class="badge badge-success badge-pill">Tips</span>
                                </div>
                                <div class="pl-4">
                                    <h5 class="lh-130">Rules not to follow</h5>
                                    <p class="text-muted mb-0">
                                        Design made simple with a clean and smart HTML markup.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 col-sm-6 mt-xl-n7">
                        <div class="card">
                            <div class="d-flex p-5">
                                <div>
                                    <span class="badge badge-danger badge-pill">Update</span>
                                </div>
                                <div class="pl-3">
                                    <h5 class="lh-130">Beware the water</h5>
                                    <p class="text-muted mb-0">
                                        Design made simple with a clean and smart HTML markup.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="d-flex p-5">
                                <div>
                                    <span class="badge badge-warning badge-pill">New</span>
                                </div>
                                <div class="pl-4">
                                    <h5 class="lh-130">Listen to the nature</h5>
                                    <p class="text-muted mb-0">
                                        Design made simple with a clean and smart HTML markup.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-6">
                        <div class="card">
                            <div class="d-flex p-5">
                                <div>
                                    <span class="badge badge-success badge-pill">Tips</span>
                                </div>
                                <div class="pl-4">
                                    <h5 class="lh-130">Rules not to follow</h5>
                                    <p class="text-muted mb-0">
                                        Design made simple with a clean and smart HTML markup.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12 col-sm-6">
                        <div class="card">
                            <div class="d-flex p-5">
                                <div>
                                    <span class="badge badge-danger badge-pill">Update</span>
                                </div>
                                <div class="pl-3">
                                    <h5 class="lh-130">Beware the water</h5>
                                    <p class="text-muted mb-0">
                                        Design made simple with a clean and smart HTML markup.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <span class="badge badge-primary badge-pill">Key features</span>
                        <h5 class="lh-180 mt-4 mb-6">Quick is a premium HTML template that includes adaptable components and pages for various industries, plus new ones each month.</h5>
                    </div>
                </div>
                <!-- Features -->
                <div class="row mx-lg-n4">
                    <!-- Features - Col 1 -->
                    <div class="col-lg-4 col-md-6 px-lg-4">
                        <div class="card shadow-none">
                            <div class="p-3 d-flex">
                                <div>
                                    <div class="icon icon-shape rounded-circle bg-warning text-white mr-4">
                                        <i data-feather="check"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="h6">100% Responsive</span>
                                    <p class="text-sm text-muted mb-0">
                                        Built to be customized.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 px-lg-4">
                        <div class="card shadow-none">
                            <div class="p-3 d-flex">
                                <div>
                                    <div class="icon icon-shape rounded-circle bg-primary text-white mr-4">
                                        <i data-feather="check"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="h6">Based on Bootstrap 4</span>
                                    <p class="text-sm text-muted mb-0">
                                        Built to be customized.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 px-lg-4">
                        <div class="card shadow-none">
                            <div class="p-3 d-flex">
                                <div>
                                    <div class="icon icon-shape rounded-circle bg-danger text-white mr-4">
                                        <i data-feather="check"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="h6">Built with SASS</span>
                                    <p class="text-sm text-muted mb-0">
                                        Built to be customized.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 px-lg-4">
                        <div class="card shadow-none">
                            <div class="p-3 d-flex">
                                <div>
                                    <div class="icon icon-shape rounded-circle bg-success text-white mr-4">
                                        <i data-feather="check"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="h6">300+ components</span>
                                    <p class="text-sm text-muted mb-0">
                                        Built to be customized.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 px-lg-4">
                        <div class="card shadow-none">
                            <div class="p-3 d-flex">
                                <div>
                                    <div class="icon icon-shape rounded-circle bg-info text-white mr-4">
                                        <i data-feather="check"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="h6">23+ widgets</span>
                                    <p class="text-sm text-muted mb-0">
                                        Built to be customized.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 px-lg-4">
                        <div class="card shadow-none">
                            <div class="p-3 d-flex">
                                <div>
                                    <div class="icon icon-shape rounded-circle bg-warning text-white mr-4">
                                        <i data-feather="check"></i>
                                    </div>
                                </div>
                                <div>
                                    <span class="h6">Bootstrap Flexbox Grid</span>
                                    <p class="text-sm text-muted mb-0">
                                        Built to be customized.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Features - Col 3 -->
                    <div class="col-lg-4 col-md-6 px-lg-4">
                        <div class="card shadow-none">
                            <div class="p-3 d-flex">
                                <div>
                                    <div>
                                        <div class="icon icon-shape rounded-circle bg-info text-white mr-4">
                                            <i data-feather="check"></i>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="h6">Animate CSS</span>
                                    <p class="text-sm text-muted mb-0">
                                        Built to be customized.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 px-lg-4">
                        <div class="card shadow-none">
                            <div class="p-3 d-flex">
                                <div>
                                    <div>
                                        <div class="icon icon-shape rounded-circle bg-danger text-white mr-4">
                                            <i data-feather="check"></i>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="h6">Integrated plugins</span>
                                    <p class="text-sm text-muted mb-0">
                                        Built to be customized.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 px-lg-4">
                        <div class="card shadow-none">
                            <div class="p-3 d-flex">
                                <div>
                                    <div>
                                        <div class="icon icon-shape rounded-circle bg-primary text-white mr-4">
                                            <i data-feather="check"></i>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <span class="h6">Smart HTML markup</span>
                                    <p class="text-sm text-muted mb-0">
                                        Built to be customized.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
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
        <footer class="position-relative" id="footer-main">
            <div class="footer pt-lg-7 footer-dark bg-dark">
                <!-- SVG shape -->
                <div class="shape-container shape-line shape-position-top shape-orientation-inverse">
                    <svg width="2560px" height="100px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="none" x="0px" y="0px" viewBox="0 0 2560 100" style="enable-background:new 0 0 2560 100;" xml:space="preserve" class=" fill-section-secondary">
                        <polygon points="2560 0 2560 100 0 100"></polygon>
                    </svg>
                </div>
                <!-- Footer -->
                <div class="container pt-4">
                    <div class="row">
                        <div class="col-lg-4 mb-5 mb-lg-0">
                            <!-- Theme's logo -->
                            <a href="index.html">
                                <img class="footer-logo" alt="Image placeholder" src="{{ asset('assets/img/logo-white.png') }}" id="footer-logo"/>
                            </a>
                            <!-- Social -->
                            <ul class="nav mt-4">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $appSettings->getFacebookUsername() }}" target="_blank">
                                        <img src="{{ asset('assets/img/facebook.svg') }}"/>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $appSettings->getInstagramUsername() }}" target="_blank">
                                        <img src="{{ asset('assets/img/instagram.svg') }}"/>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $appSettings->getTwitterUsername() }}" target="_blank">
                                        <img src="{{ asset('assets/img/twitter.svg') }}"/>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr class="divider divider-fade divider-dark my-4">
                    <div class="row align-items-center justify-content-md-between pb-4">
                        <div class="col-md-6">
                            <div class="copyright text-sm font-weight-bold text-center text-md-left">
                                &copy; {{ date('Y') }} <a href="{{ url('/') }}" class="font-weight-bold" target="_blank">{{ config('app.name') }}</a>. All rights reserved
                            </div>
                        </div>
                        <div class="col-md-6">
                            <ul class="nav justify-content-center justify-content-md-end mt-3 mt-md-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Terms
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Privacy
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Cookies
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/popper.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/baddiservices.main.js') }}"></script>
    </body>
</html>