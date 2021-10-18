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
                                <img class="footer-logo"  src="{{ asset('assets/img/white-logo.svg') }}" id="footer-logo"/>
                            </a>
                            <!-- Social -->
                            <ul class="nav mt-4">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $settings->getFacebookUsername() }}" target="_blank">
                                        <img src="{{ asset('assets/img/facebook.svg') }}"/>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $settings->getInstagramUsername() }}" target="_blank">
                                        <img src="{{ asset('assets/img/instagram.svg') }}"/>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $settings->getTwitterUsername() }}" target="_blank">
                                        <img src="{{ asset('assets/img/twitter.svg') }}"/>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr class="divider divider-fade divider-dark my-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <a href="{{ $settings->getAppLinkOnShopifyAppStore() }}" target="_blank" class="avatar mb-3" style="width: 10rem;">
                                <img src="{{ asset('assets/img/Shopify-App-Store-Badge.svg') }}" alt="Find it on the Shopify App Store"/>
                            </a>
                        </div>
                    </div>
                    <div class="row align-items-center justify-content-md-between pb-4">
                        <div class="col-md-6">
                            <div class="copyright text-sm font-weight-bold text-center text-md-left">
                                &copy; {{ date('Y') }} <a href="{{ url('/') }}" class="font-weight-bold" target="_blank">{{ config('app.name') }}</a>. All rights reserved
                            </div>
                        </div>
                        <div class="col-md-6">
                            <ul class="nav justify-content-center justify-content-md-end mt-3 mt-md-0">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('privacy') }}">
                                        Privacy
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('privacy') }}">
                                        Terms
                                    </a>
                                </li> --}}
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
