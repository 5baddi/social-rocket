
<html lang="en" dir="ltr"
class="js windows chrome desktop page--no-banner page--logo-main page--thank-you card-fields cors svg opacity placeholder no-touchevents displaytable display-table generatedcontent cssanimations flexbox no-flexboxtweener anyflexbox no-shopemoji"
style="overflow: visible; height: auto;">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, height=device-height, minimum-scale=1.0, user-scalable=0">
        <meta name="referrer" content="origin">
        <title> Thank you for your purchase! - {{ config('app.name') }} Store - Checkout</title>
        <link rel="icon" type="image/png" href="{{ asset('img/mini-logo.png') }}"/>
        <meta data-browser="chrome" data-browser-major="87">
        <meta
            data-body-font-family="-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'"
            data-body-font-type="system">
        <link rel="stylesheet" media="all" href="{{ asset('assets/css/preview/checkout.css') }}"/>
        <style type="text/css">
            .srow {
                display: flex;
                align-items: center;
            }

            .scolumn-text {
                width: 65%;
            }

            .scolumn-share {
                width: 35%;
                padding-right: 5%;
            }

            @media  screen and (max-width: 485px) {
                .srow {
                    display: block;
                }

                .scolumn-text {
                    width: 100%;
                }

                .scolumn-share {
                    width: 100%;
                    margin-top: 10px;
                }
            }
        </style>
    </head>
    <body data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="overflow: visible; height: auto;">
        <a href="#main-header" class="skip-to-content">
            Skip to content
        </a>

        <header class="banner" data-header="" role="banner">
            <div class="wrap">

                <a class="logo logo--left" href="#"><span
                        class="logo__text heading-1">{{ config('app.name') }} Store</span></a>

                <h1 class="visually-hidden">
                    Thank you for your purchase!
                </h1>

            </div>
        </header>

        <aside role="complementary">
            <button class="order-summary-toggle order-summary-toggle--show shown-if-js" aria-expanded="false"
                aria-controls="order-summary" data-drawer-toggle="[data-order-summary]">
                <span class="wrap">
                    <span class="order-summary-toggle__inner">
                        <span class="order-summary-toggle__icon-wrapper">
                            <svg width="20" height="19" xmlns="http://www.w3.org/2000/svg"
                                class="order-summary-toggle__icon">
                                <path
                                    d="M17.178 13.088H5.453c-.454 0-.91-.364-.91-.818L3.727 1.818H0V0h4.544c.455 0 .91.364.91.818l.09 1.272h13.45c.274 0 .547.09.73.364.18.182.27.454.18.727l-1.817 9.18c-.09.455-.455.728-.91.728zM6.27 11.27h10.09l1.454-7.362H5.634l.637 7.362zm.092 7.715c1.004 0 1.818-.813 1.818-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817zm9.18 0c1.004 0 1.817-.813 1.817-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817z">
                                </path>
                            </svg>
                        </span>
                        <span class="order-summary-toggle__text order-summary-toggle__text--show">
                            <span>Show order summary</span>
                            <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg"
                                class="order-summary-toggle__dropdown" fill="#000">
                                <path
                                    d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z">
                                </path>
                            </svg>
                        </span>
                        <span class="order-summary-toggle__text order-summary-toggle__text--hide">
                            <span>Hide order summary</span>
                            <svg width="11" height="7" xmlns="http://www.w3.org/2000/svg"
                                class="order-summary-toggle__dropdown" fill="#000">
                                <path
                                    d="M6.138.876L5.642.438l-.496.438L.504 4.972l.992 1.124L6.138 2l-.496.436 3.862 3.408.992-1.122L6.138.876z">
                                </path>
                            </svg>
                        </span>
                        <dl class="order-summary-toggle__total-recap total-recap"
                            data-order-summary-section="toggle-total-recap">
                            <dt class="visually-hidden"><span>Original price</span></dt>
                            <dd><s class="total-recap__original-price remove-while-loading"
                                    data-checkout-original-payment-due-target="">{{ $price }}</s></dd>
                            <dt class="visually-hidden"><span>Sale price</span></dt>
                            <dd>
                                <span class="order-summary__emphasis total-recap__final-price skeleton-while-loading"
                                    data-checkout-payment-due-target="10449">${{ $total }}</span>
                            </dd>
                        </dl>
                    </span></span></button>
        </aside>

        <div class="content" data-content="">
            <div class="wrap">
                <div class="main">
                    <header class="main__header" role="banner">

                        <a class="logo logo--left" href="#"><span
                                class="logo__text heading-1">{{ config('app.name') }} Store</span></a>

                        <h1 class="visually-hidden">
                            Thank you for your purchase!
                        </h1>

                        <div class="shown-if-js" data-alternative-payments="">
                        </div>

                    </header>
                    <main class="main__content" role="main">

                        <div class="step" data-step="thank_you" data-last-step="false">
                            <div class="step__sections">
                                <div class="section" data-order-update-options="[]">
                                    <div class="section__header os-header">
                                        <svg class="icon-svg icon-svg--color-accent icon-svg--size-48 os-header__hanging-icon os-header__hanging-icon--animate"
                                            aria-hidden="true" focusable="false">
                                            <use xlink:href="#checkmark"></use>
                                        </svg>
                                        <div class="os-header__heading">
                                            <span class="os-order-number">
                                                Order #{{ $order }}
                                            </span>
                                            <h2 class="os-header__title" id="main-header" tabindex="-1">
                                                Thank you {{ ucwords($user->first_name) }}!
                                            </h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="section">
                                    <div class="section__content">

                                        
                                        <div class="content-box">
                                            <div class="content-box__row">
                                                <div class="section__content srow">
                                                    <div class="section__content__column scolumn-text">
                                                        <div class="text-container">
                                                            <h2 id="offer_header"
                                                                style="font-weight: 600; font-size: 23px;">
                                                                You can make money promoting our products!</h2>
                                                            <p class="os-step__description">Simply share the discount code
                                                                we created just for you <svg
                                                                    class="sloading"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    style="margin: auto; background: rgb(255, 255, 255); display: none; vertical-align: middle;"
                                                                    width="20px" height="20px" viewBox="0 0 100 100"
                                                                    preserveAspectRatio="xMidYMid">
                                                                    <circle cx="50" cy="50" fill="none" stroke="#2c407d"
                                                                        stroke-width="10" r="35"
                                                                        stroke-dasharray="164.93361431346415 56.97787143782138"
                                                                        transform="rotate(336.538 50 50)">
                                                                        <animateTransform attributeName="transform"
                                                                            type="rotate" repeatCount="indefinite" dur="1s"
                                                                            values="0 50 50;360 50 50" keyTimes="0;1">
                                                                        </animateTransform>
                                                                    </circle>
                                                                </svg> <span class="scode"
                                                                    id="scode"
                                                                    style="font-weight: bold;">{{ $code }}</span> and receive
                                                                <b style="font-weight: bold;"><svg
                                                                        class="sloading_merchant_commission"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                        style="margin: auto; background: rgb(255, 255, 255); display: none; vertical-align: middle;"
                                                                        width="20px" height="20px" viewBox="0 0 100 100"
                                                                        preserveAspectRatio="xMidYMid">
                                                                        <circle cx="50" cy="50" fill="none" stroke="#2c407d"
                                                                            stroke-width="10" r="35"
                                                                            stroke-dasharray="164.93361431346415 56.97787143782138"
                                                                            transform="rotate(336.538 50 50)">
                                                                            <animateTransform attributeName="transform"
                                                                                type="rotate" repeatCount="indefinite"
                                                                                dur="1s" values="0 50 50;360 50 50"
                                                                                keyTimes="0;1"></animateTransform>
                                                                        </circle>
                                                                    </svg> <span
                                                                        class="smerchant_commission"
                                                                        style="font-weight: bold;">
                                                                        {{ $percentage }}%
                                                                    </span></b> every time
                                                                someone purchases using your code!</p>
                                                            <p style="margin-top: 8px;"><a href="#"
                                                                    style="margin-top: 8px !important; font-size: 12px; font-weight: 700;"
                                                                    onclick="window.modalInfo()"> Full offer details </a>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="section__content__column scolumn-share">
                                                        <div class="text-container">
                                                            <ul class="payment-method-list"
                                                                style="text-align: right; margin-left: 25px;">
                                                                <li class="payment-method-list__item"
                                                                    style="text-align: center; ">
                                                                    <div style="width: 100%;">
                                                                        <p style="">Share now and start earning
                                                                            <img
                                                                                src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/img/icon-arrow-bottom2.png"
                                                                                alt="Arrow pointing down"
                                                                                style="display: inline-block; vertical-align: middle; width: 13px; " />
                                                                        </p>
                                                                    </div>
                                                                </li>
                                                                <li class="payment-method-list__item"
                                                                    style="text-align: center; ">
                                                                    <div style="width: 100%;"><a
                                                                            style="color: #fff; display: inline-block; padding: 8px 16px 8px 13px; background-color: #3C57B3; border-radius: 30px; cursor: pointer; width: 88%;"
                                                                            onclick="window.shareFacebook()">
                                                                            <img
                                                                                src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/img/facebook.svg"
                                                                                alt="Facebook logo"
                                                                                style="width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle;">
                                                                                Share
                                                                                </a>
                                                                            </img>
                                                                </li>
                                                                <li class="payment-method-list__item"
                                                                    style="text-align: center; ">
                                                                    <div style="width: 100%;"><a
                                                                            style="color: #40ABEE; font-weight: 600; display: inline-block; padding: 8px 15px 8px 12px; background-color: #000000; border-radius: 30px; cursor: pointer; width: 88%;"
                                                                            onclick="window.shareTwitter()"><img
                                                                                src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/img/twitter.svg"
                                                                                alt="Twitter logo"
                                                                                style="width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle; ">Share</a>
                                                                    </div>
                                                                </li>
                                                                <li class="payment-method-list__item"
                                                                    style="text-align: center; ">
                                                                    <div style="width: 100%;"><a
                                                                            style="color: #fff; display: inline-block; padding: 8px 16px 8px 13px; background-color: #8D9DAD; border-radius: 30px; cursor: pointer; width: 88%;"
                                                                            onclick="window.copyLink()"><svg version="1.1"
                                                                                id="Capa_1"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                x="0px" y="0px" viewBox="0 0 512 512"
                                                                                style="enable-background:new 0 0 512 512; width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle;"
                                                                                xml:space="preserve">
                                                                                <g>
                                                                                    <path
                                                                                        d="M464,64h-48V48c0-26.51-21.49-48-48-48H48C21.49,0,0,21.49,0,48v320c0,26.51,21.49,48,48,48h16v48c0,26.51,21.49,48,48,48 h352c26.51,0,48-21.49,48-48V112C512,85.49,490.51,64,464,64z M64,112v272H48c-8.837,0-16-7.163-16-16V48c0-8.837,7.163-16,16-16 h320c8.837,0,16,7.163,16,16v16H112C85.49,64,64,85.49,64,112z M480,464c0,8.837-7.163,16-16,16H112c-8.837,0-16-7.163-16-16V112 c0-8.837,7.163-16,16-16h352c8.837,0,16,7.163,16,16V464z"
                                                                                        fill="#fff"></path>
                                                                                </g>
                                                                            </svg>Copy code</a></div>
                                                                </li>
                                                            </ul> <input class="smerchant_name"
                                                                type="hidden" value="{{ ucwords($user->first_name) }}"> <input
                                                                class="smerchant_discount" type="hidden"
                                                                value="10%"> <input class="samount_code"
                                                                type="hidden" value="10%"> <input
                                                                class="smerchant_store" type="hidden"
                                                                value="{{ config('app.name') }} Store">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        
                                        <div id="offer-details"
                                            style="background-color: rgba(0,0,0,0.4); position: fixed; top: 0; right: 0; bottom: 0; left: 0; width: 100%; height: 100%; display: none; align-items:center; justify-content: center; z-index: 9999;">
                                            <div
                                                style="background-color: #ffffff; text-align: center; color: #000000; font-size: 18px; padding: 15px 25px; width: 320px;">
                                                <img src="{{ asset('img/logo.png') }}"
                                                    id="offer-details-logo"
                                                    style="display: none; vertical-align: middle; width: 60%;">
                                                <p style="font-weight: 600">Affiliate Program</p>
                                                <hr>
                                                <p
                                                    style="text-align: left; margin-left: 10px; margin-right: 10px; font-size: 15px;">
                                                    Welcome to our affiliate program! When someone makes a purchase using
                                                    your discount code, we’ll send you an email with login info to your
                                                    affiliate portal so you can track your sales and receive payouts. Please
                                                    email us if you have any questions or concerns.</p>
                                                <hr>
                                                <div class="text-container" style="width: 100%; margin-top: 8px;"><a
                                                        href="#"
                                                        style="margin-top: 8px !important; font-size: 15px; font-weight: 700; float: right; margin-right: 10px;"
                                                        onclick="window.modalClose()">Accept</a></div>
                                            </div>
                                        </div>
                                        

                                        <div class="content-box">
                                            <div class="content-box__row text-container">
                                                <h2 class="heading-2 os-step__title">Your order is confirmed</h2>
                                                <div class="os-step__special-description">
                                                    <p class="os-step__description">
                                                        You’ll receive a confirmation email with your order number shortly.
                                                    </p>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="content-box">
                                            <div class="content-box__row content-box__row--no-border">
                                                <h2>Customer information</h2>
                                            </div>
                                            <div class="content-box__row">
                                                <div class="section__content">
                                                    <div class="section__content__column section__content__column--half">
                                                        <div class="text-container">
                                                            <h3 class="heading-3">Contact information</h3>

                                                            <p><bdo dir="ltr">{{ ucwords($user->first_name) }}&#64;{{ str_replace(' ', '', config('app.name')) }}.com</bdo></p>

                                                            <h3 class="heading-3">Shipping address</h3>
                                                            <address class="address">{{ ucwords($user->first_name) }}<br>{{ $streetName }}<br>{{ $streetAddress }}<br>{{ $city }}<br>{{ $zip }}<br>{{ $country }}</address>

                                                            <h3 class="heading-3">Shipping method</h3>
                                                            <p>First Class Package International</p>
                                                        </div>
                                                    </div>

                                                    <div class="section__content__column section__content__column--half">
                                                        <div class="text-container">
                                                            <h3 class="heading-3">Payment method</h3>

                                                            <ul class="payment-method-list">
                                                                <li class="payment-method-list__item">
                                                                    <i class="payment-icon payment-icon--bogus payment-method-list__item-icon">
                                                                        <span class="visually-hidden">Visa</span>
                                                                        <svg version="1.1" height="26px" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 504 504" style="enable-background:new 0 0 504 504;" xml:space="preserve">
                                                                            <polygon style="fill:#3C58BF;" points="184.8,324.4 210.4,180.4 250.4,180.4 225.6,324.4 "/>
                                                                            <polygon style="fill:#293688;" points="184.8,324.4 217.6,180.4 250.4,180.4 225.6,324.4 "/>
                                                                            <path style="fill:#3C58BF;" d="M370.4,182c-8-3.2-20.8-6.4-36.8-6.4c-40,0-68.8,20-68.8,48.8c0,21.6,20,32.8,36,40
                                                                                s20.8,12,20.8,18.4c0,9.6-12.8,14.4-24,14.4c-16,0-24.8-2.4-38.4-8l-5.6-2.4l-5.6,32.8c9.6,4,27.2,8,45.6,8
                                                                                c42.4,0,70.4-20,70.4-50.4c0-16.8-10.4-29.6-34.4-40c-14.4-7.2-23.2-11.2-23.2-18.4c0-6.4,7.2-12.8,23.2-12.8
                                                                                c13.6,0,23.2,2.4,30.4,5.6l4,1.6L370.4,182L370.4,182z"/>
                                                                            <path style="fill:#293688;" d="M370.4,182c-8-3.2-20.8-6.4-36.8-6.4c-40,0-61.6,20-61.6,48.8c0,21.6,12.8,32.8,28.8,40
                                                                                s20.8,12,20.8,18.4c0,9.6-12.8,14.4-24,14.4c-16,0-24.8-2.4-38.4-8l-5.6-2.4l-5.6,32.8c9.6,4,27.2,8,45.6,8
                                                                                c42.4,0,70.4-20,70.4-50.4c0-16.8-10.4-29.6-34.4-40c-14.4-7.2-23.2-11.2-23.2-18.4c0-6.4,7.2-12.8,23.2-12.8
                                                                                c13.6,0,23.2,2.4,30.4,5.6l4,1.6L370.4,182L370.4,182z"/>
                                                                            <path style="fill:#3C58BF;" d="M439.2,180.4c-9.6,0-16.8,0.8-20.8,10.4l-60,133.6h43.2l8-24h51.2l4.8,24H504l-33.6-144H439.2z
                                                                                M420.8,276.4c2.4-7.2,16-42.4,16-42.4s3.2-8.8,5.6-14.4l2.4,13.6c0,0,8,36,9.6,44h-33.6V276.4z"/>
                                                                            <path style="fill:#293688;" d="M448.8,180.4c-9.6,0-16.8,0.8-20.8,10.4l-69.6,133.6h43.2l8-24h51.2l4.8,24H504l-33.6-144H448.8z
                                                                                M420.8,276.4c3.2-8,16-42.4,16-42.4s3.2-8.8,5.6-14.4l2.4,13.6c0,0,8,36,9.6,44h-33.6V276.4z"/>
                                                                            <path style="fill:#3C58BF;" d="M111.2,281.2l-4-20.8c-7.2-24-30.4-50.4-56-63.2l36,128h43.2l64.8-144H152L111.2,281.2z"/>
                                                                            <path style="fill:#293688;" d="M111.2,281.2l-4-20.8c-7.2-24-30.4-50.4-56-63.2l36,128h43.2l64.8-144H160L111.2,281.2z"/>
                                                                            <path style="fill:#FFBC00;" d="M0,180.4l7.2,1.6c51.2,12,86.4,42.4,100,78.4l-14.4-68c-2.4-9.6-9.6-12-18.4-12H0z"/>
                                                                            <path style="fill:#F7981D;" d="M0,180.4L0,180.4c51.2,12,93.6,43.2,107.2,79.2l-13.6-56.8c-2.4-9.6-10.4-15.2-19.2-15.2L0,180.4z"/>
                                                                            <path style="fill:#ED7C00;" d="M0,180.4L0,180.4c51.2,12,93.6,43.2,107.2,79.2l-9.6-31.2c-2.4-9.6-5.6-19.2-16.8-23.2L0,180.4z"/>
                                                                            <g>
                                                                                <path style="fill:#051244;" d="M151.2,276.4L124,249.2l-12.8,30.4l-3.2-20c-7.2-24-30.4-50.4-56-63.2l36,128h43.2L151.2,276.4z"/>
                                                                                <polygon style="fill:#051244;" points="225.6,324.4 191.2,289.2 184.8,324.4 	"/>
                                                                                <path style="fill:#051244;" d="M317.6,274.8L317.6,274.8c3.2,3.2,4.8,5.6,4,8.8c0,9.6-12.8,14.4-24,14.4c-16,0-24.8-2.4-38.4-8
                                                                                    l-5.6-2.4l-5.6,32.8c9.6,4,27.2,8,45.6,8c25.6,0,46.4-7.2,58.4-20L317.6,274.8z"/>
                                                                                <path style="fill:#051244;" d="M364,324.4h37.6l8-24h51.2l4.8,24H504L490.4,266l-48-46.4l2.4,12.8c0,0,8,36,9.6,44h-33.6
                                                                                    c3.2-8,16-42.4,16-42.4s3.2-8.8,5.6-14.4"/>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                            <g>
                                                                            </g>
                                                                        </svg>
                                                                    </i>
                                                                    <span class="payment-method-list__item__info">ending with 1</span>
                                                                    <span class="payment-method-list__item__amount emphasis"> - ${{ $price }}</span>
                                                                </li>
                                                            </ul>
                                                            <h3 class="heading-3">Billing address</h3>
                                                            <address class="address">{{ ucwords($user->first_name) }}<br>{{ $streetName }}<br>{{ $streetAddress }}<br>{{ $city }}<br>{{ $zip }}<br>{{ $country }}</address>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="step__footer">
                                <a href="#" data-osp-continue-button=""
                                    class="step__footer__continue-btn btn">
                                    <span class="btn__content">Continue shopping</span>
                                    <svg class="icon-svg icon-svg--size-18 btn__spinner icon-svg--spinner-button"
                                        aria-hidden="true" focusable="false">
                                        <use xlink:href="#spinner-button"></use>
                                    </svg>
                                </a>
                                <p class="step__footer__info">
                                    Need help? <a data-contact-us-link="true"
                                        href="#">Contact us</a>
                                </p>
                            </div>
                        </div>

                        <div class="hidden">
                            <span class="visually-hidden" id="forwarding-external-new-window-message">
                                Opens external website in a new window.
                            </span>

                            <span class="visually-hidden" id="forwarding-new-window-message">
                                Opens in a new window.
                            </span>

                            <span class="visually-hidden" id="forwarding-external-message">
                                Opens external website.
                            </span>

                            <span class="visually-hidden" id="checkout-context-step-one">
                                Customer information - {{ config('app.name') }} Store - Checkout
                            </span>
                        </div>

                    </main>
                    <footer class="main__footer" role="contentinfo">
                        <p class="copyright-text ">
                            All rights reserved {{ config('app.name') }} Store
                        </p>

                    </footer>
                </div>
                <aside class="sidebar" role="complementary">
                    <div class="sidebar__header">

                        <a class="logo logo--left" href="#"><span
                                class="logo__text heading-1">{{ config('app.name') }} Store</span></a>

                        <h1 class="visually-hidden">
                            Thank you for your purchase!
                        </h1>

                    </div>
                    <div class="sidebar__content">
                        <div id="order-summary" class="order-summary order-summary--is-collapsed" data-order-summary="">
                            <h2 class="visually-hidden-if-js">Order summary</h2>

                            <div class="order-summary__sections">
                                <div class="order-summary__section order-summary__section--product-list">
                                    <div class="order-summary__section__content">
                                        <table class="product-table">
                                            <caption class="visually-hidden">Shopping cart</caption>
                                            <thead class="product-table__header">
                                                <tr>
                                                    <th scope="col"><span class="visually-hidden">Product image</span></th>
                                                    <th scope="col"><span class="visually-hidden">Description</span></th>
                                                    <th scope="col"><span class="visually-hidden">Quantity</span></th>
                                                    <th scope="col"><span class="visually-hidden">Price</span></th>
                                                </tr>
                                            </thead>
                                            <tbody data-order-summary-section="line-items">
                                                <tr class="product" data-product-id="6173420945607"
                                                    data-variant-id="37959907770567" data-product-type=""
                                                    data-customer-ready-visible="">
                                                    <td class="product__image">
                                                        <div class="product-thumbnail ">
                                                            <div class="product-thumbnail__wrapper">
                                                                <img alt="Test Product" class="product-thumbnail__image" src="{{ asset('assets/img/fake-product.jpeg') }}">
                                                            </div>
                                                            <span class="product-thumbnail__quantity"
                                                                aria-hidden="true">1</span>
                                                        </div>

                                                    </td>
                                                    <th class="product__description" scope="row">
                                                        <span
                                                            class="product__description__name order-summary__emphasis">{{ $product }}</span>
                                                        <span
                                                            class="product__description__variant order-summary__small-text"></span>

                                                    </th>
                                                    <td class="product__quantity">
                                                        <span class="visually-hidden">
                                                            1
                                                        </span>
                                                    </td>
                                                    <td class="product__price">
                                                        <span
                                                            class="order-summary__emphasis skeleton-while-loading">${{ $price }}</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="order-summary__scroll-indicator" aria-hidden="true" tabindex="-1">
                                            Scroll for more items
                                            <svg aria-hidden="true" focusable="false" class="icon-svg icon-svg--size-12">
                                                <use xlink:href="#down-arrow"></use>
                                            </svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="order-summary__section order-summary__section--total-lines"
                                    data-order-summary-section="payment-lines">
                                    <table class="total-line-table">
                                        <caption class="visually-hidden">Cost summary</caption>
                                        <thead>
                                            <tr>
                                                <th scope="col"><span class="visually-hidden">Description</span></th>
                                                <th scope="col"><span class="visually-hidden">Price</span></th>
                                            </tr>
                                        </thead>
                                        <tbody class="total-line-table__tbody">
                                            <tr class="total-line total-line--subtotal">
                                                <th class="total-line__name" scope="row">Subtotal</th>
                                                <td class="total-line__price">
                                                    <span class="order-summary__emphasis skeleton-while-loading"
                                                        data-checkout-subtotal-price-target="{{ $price }}">
                                                        ${{ $price }}
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr class="total-line total-line--reduction " data-discount-type="percentage">
                                                <th class="total-line__name" scope="row">
                                                    <span>Discount</span>
                                                    <span class="reduction-code">
                                                        <svg class="icon-svg icon-svg--color-adaptive-light icon-svg--size-18 reduction-code__icon"
                                                            aria-hidden="true" focusable="false">
                                                            <use xlink:href="#tags-filled"></use>
                                                        </svg>
                                                        <span class="reduction-code__text">{{ $secondCode }}</span>
                                                    </span>
                                                </th>

                                                <td class="total-line__price">
                                                    <span class="order-summary__emphasis skeleton-while-loading"
                                                        aria-hidden="true" data-checkout-discount-amount-target="{{ $discount }}">
                                                        - ${{ $discount }}
                                                    </span>
                                                    <span class="visually-hidden skeleton-while-loading-sr">
                                                        ${{ $discount }} off total order price
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr class="total-line total-line--shipping">
                                                <th class="total-line__name" scope="row">
                                                    <span>
                                                        Shipping
                                                    </span>

                                                </th>
                                                <td class="total-line__price">
                                                    <span class="skeleton-while-loading order-summary__emphasis"
                                                        data-checkout-total-shipping-target="{{ $total }}">
                                                        ${{ $shipping }}
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr class="total-line total-line--taxes hidden" data-checkout-taxes="">
                                                <th class="total-line__name" scope="row">Taxes</th>
                                                <td class="total-line__price">
                                                    <span class="order-summary__emphasis skeleton-while-loading"
                                                        data-checkout-total-taxes-target="0">$0.00</span>
                                                </td>
                                            </tr>

                                        </tbody>
                                        <tfoot class="total-line-table__footer">
                                            <tr class="total-line">
                                                <th class="total-line__name payment-due-label" scope="row">
                                                    <span class="payment-due-label__total">Total</span>
                                                </th>
                                                <td class="total-line__price payment-due" data-presentment-currency="USD">
                                                    <span class="payment-due__currency remove-while-loading">USD</span>
                                                    <span class="payment-due__price skeleton-while-loading--lg"
                                                        data-checkout-payment-due-target="10449">
                                                        ${{ $total }}
                                                    </span>
                                                </td>
                                            </tr>

                                        </tfoot>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <div class="visually-hidden" data-order-summary-section="accessibility-live-region">
                            <div aria-live="polite" aria-atomic="true" role="status">
                                Updated total price:
                                <span data-checkout-payment-due-target="10449">
                                    ${{ $total }}
                                </span>
                            </div>
                        </div>

                        <div id="partial-icon-symbols" class="icon-symbols" data-tg-refresh="partial-icon-symbols"
                            data-tg-refresh-always="true"><svg xmlns="http://www.w3.org/2000/svg">
                                <symbol id="checkmark"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"
                                        fill="none" stroke-width="2" class="checkmark">
                                        <path class="checkmark__circle"
                                            d="M25 49c13.255 0 24-10.745 24-24S38.255 1 25 1 1 11.745 1 25s10.745 24 24 24z">
                                        </path>
                                        <path class="checkmark__check" d="M15 24.51l7.307 7.308L35.125 19"></path>
                                    </svg></symbol>
                                <symbol id="spinner-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path
                                            d="M20 10c0 5.523-4.477 10-10 10S0 15.523 0 10 4.477 0 10 0v2c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8h2z">
                                        </path>
                                    </svg></symbol>
                                <symbol id="down-arrow"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 12">
                                        <path
                                            d="M10.817 7.624l-4.375 4.2c-.245.235-.64.235-.884 0l-4.375-4.2c-.244-.234-.244-.614 0-.848.245-.235.64-.235.884 0L5.375 9.95V.6c0-.332.28-.6.625-.6s.625.268.625.6v9.35l3.308-3.174c.122-.117.282-.176.442-.176.16 0 .32.06.442.176.244.234.244.614 0 .848">
                                        </path>
                                    </svg></symbol>
                                <symbol id="tags-filled"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                                        <path
                                            d="M17.78 3.09C17.45 2.443 16.778 2 16 2h-5.165c-.535 0-1.046.214-1.422.593l-6.82 6.89c0 .002 0 .003-.002.003-.245.253-.413.554-.5.874L.738 8.055c-.56-.953-.24-2.178.712-2.737L9.823.425C10.284.155 10.834.08 11.35.22l4.99 1.337c.755.203 1.293.814 1.44 1.533z"
                                            fill-opacity=".55"></path>
                                        <path
                                            d="M10.835 2H16c1.105 0 2 .895 2 2v5.172c0 .53-.21 1.04-.586 1.414l-6.818 6.818c-.777.778-2.036.782-2.82.01l-5.166-5.1c-.786-.775-.794-2.04-.02-2.828.002 0 .003 0 .003-.002l6.82-6.89C9.79 2.214 10.3 2 10.835 2zM13.5 8c.828 0 1.5-.672 1.5-1.5S14.328 5 13.5 5 12 5.672 12 6.5 12.672 8 13.5 8z">
                                        </path>
                                    </svg></symbol>
                            </svg></div>

                    </div>
                </aside>
            </div>
        </div>


        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var color = localStorage.getItem('checkout-color');
                var el = document.getElementById('offer_header');
                if (el && el !== 'undefined') {
                    el.style.color = color || '{{ \BADDIServices\SocialRocket\Models\Setting::DEFAULT_COLOR }}';
                }

                window.modalInfo = function () {
                    document.getElementById('offer-details').style.display = "flex";
                }

                window.modalClose = function () {
                    document.getElementById('offer-details').style.display = "none";
                }

                window.copyLink = function () {
                    var codeToCopy = document.getElementById('scode');
                    var selection = document.createRange();
                    selection.selectNodeContents(codeToCopy);
                    window.getSelection().removeAllRanges();
                    window.getSelection().addRange(selection);
                    var res = document.execCommand('copy');
                    window.getSelection().removeRange(selection);
                }

                window.shareFacebook = function () {

                }

                window.shareTwitter = function () {

                }
            });
        </script>
    </body>
</html>