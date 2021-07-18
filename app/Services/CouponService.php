<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Illuminate\Support\Str;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Setting;

class CouponService extends Service
{
    public function getScriptTag(float $discount = Setting::DFEAULT_DISCOUNT, string $type = Setting::FIXED_TYPE, string $currency = Setting::DEFAULT_CURRENCY, $color = Setting::DEFAULT_COLOR)
    {
        $html = '<div id="app-affiliate-section" class="section__content srow" style="display:none;">
            <div class="section__content__column scolumn-text" style="width: 65%;">
            <div class="text-container">
                <h2 id="offer_header" style="font-weight: 600; font-size: 23px; color: {color};"> You can make money promoting our products!</h2>
                <p class="os-step__description">
                    Simply share the discount code we created just for you 
                    <svg class="sloading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: none; vertical-align: middle;" width="20px" height="20px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                        <circle cx="50" cy="50" fill="none" stroke="#2c407d" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138" transform="rotate(336.538 50 50)">
                        <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"> </animateTransform>
                        </circle>
                    </svg>
                    <span class="scode" id="app-coupon" style="font-weight: bold;">{coupon}</span> and receive 
                    <b style="font-weight: bold;">
                        <svg class="sloading_merchant_commission" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: none; vertical-align: middle;" width="20px" height="20px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                        <circle cx="50" cy="50" fill="none" stroke="#2c407d" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138" transform="rotate(336.538 50 50)">
                            <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                        </circle>
                        </svg>
                        <span id="app-discount" class="smerchant_commission" style="font-weight: bold;"> {amount} </span>
                    </b>
                    every time someone purchases using your code!
                </p>
                <p style="margin-top: 8px;"><a href="#" style="margin-top: 8px !important; font-size: 12px; font-weight: 700;" onclick="window.modalInfo()"> Full offer details </a> </p>
            </div>
            </div>
            <div class="section__content__column scolumn-share" style="width: 35%;padding-right: 5%;">
            <div class="text-container">
                <ul class="payment-method-list" style="text-align: right; margin-left: 25px;">
                    <li class="payment-method-list__item" style="text-align: center; ">
                        <div style="width: 100%;">
                        <p style="">Share now and start earning <br/><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="18" y1="13" x2="12" y2="19"></line>
                        <line x1="6" y1="13" x2="12" y2="19"></line>
                    </svg></p>
                        </div>
                    </li>
                    <li class="payment-method-list__item" style="text-align: center; ">
                        <div style="width: 100%;"><a style="color: #fff; display: inline-block; padding: 8px 16px 8px 13px; background-color: #3C57B3; border-radius: 30px; cursor: pointer; width: 88%;" onclick="window.shareFacebook()"><svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle; " class="icon icon-tabler icon-tabler-brand-facebook" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3"></path>
                    </svg>Share</a> </div>
                    </li>
                    <li class="payment-method-list__item" style="text-align: center; ">
                        <div style="width: 100%;"><a style="color: #40ABEE; font-weight: 600; display: inline-block; padding: 8px 15px 8px 12px; background-color: #000000; border-radius: 30px; cursor: pointer; width: 88%;" onclick="window.shareTwitter()"><svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle; " class="icon icon-tabler icon-tabler-brand-twitter" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z"></path>
                    </svg>Share</a> </div>
                    </li>
                    <li class="payment-method-list__item" style="text-align: center; ">
                        <div style="width: 100%;">
                        <a style="color: #fff; display: inline-block; padding: 8px 16px 8px 13px; background-color: #8D9DAD; border-radius: 30px; cursor: pointer; width: 88%;" onclick="window.copyLink()">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle;" xml:space="preserve">
                                <g>
                                    <path d="M464,64h-48V48c0-26.51-21.49-48-48-48H48C21.49,0,0,21.49,0,48v320c0,26.51,21.49,48,48,48h16v48c0,26.51,21.49,48,48,48 h352c26.51,0,48-21.49,48-48V112C512,85.49,490.51,64,464,64z M64,112v272H48c-8.837,0-16-7.163-16-16V48c0-8.837,7.163-16,16-16 h320c8.837,0,16,7.163,16,16v16H112C85.49,64,64,85.49,64,112z M480,464c0,8.837-7.163,16-16,16H112c-8.837,0-16-7.163-16-16V112 c0-8.837,7.163-16,16-16h352c8.837,0,16,7.163,16,16V464z" fill="#fff"></path>
                                </g>
                            </svg>
                            <span id="copy-msg">Copy code</span>
                        </a>
                        </div>
                    </li>
                </ul>
                <input class="smerchant_name" type="hidden" value="Harper"> <input class="smerchant_discount" type="hidden" value="10%"> <input class="samount_code" type="hidden" value="10%"> <input class="smerchant_store" type="hidden" value="ClnkGO Store"> 
            </div>
            </div>
        </div>
        <div id="offer-details"
            style="background-color: rgba(0,0,0,0.4); position: fixed; top: 0; right: 0; bottom: 0; left: 0; width: 100%; height: 100%; display: none; align-items:center; justify-content: center; z-index: 9999;">
            <div
                style="background-color: #ffffff; text-align: center; color: #000000; font-size: 18px; padding: 15px 25px; width: 320px;">
                <img src="' . asset('assets/img/logo.png') . '"
                    id="offer-details-logo"
                    style="vertical-align: middle; width: 60%; margin-bottom: 1.5rem;">
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
        </div>';

        $amount = $this->getDiscount($discount, $type, $currency);
        
        $html = Str::replace('{color}', $color, $html);
        $html = Str::replace('{amount}', $amount, $html);

        return $html;
    }

    public function getDiscount(float $discount, string $type = Setting::FIXED_TYPE, $currency = Setting::DEFAULT_CURRENCY): ?string
    {
        $amount = number_format($discount, 2);

        if ($type === Setting::FIXED_TYPE) {
            $amount .= ' ' . $currency;
        } else {
            $amount .= '%';
        }

        return $amount;
    }

    public function generateDiscountCode(Store $store, string $first_name): string
    {
        $store->load('setting');

        /** @var Setting */
        $setting = $store->setting;

        $uniqueNumber = substr(uniqid(mt_rand()), 0, 4);

        if (is_null($setting) || $setting->discount_amount === Setting::UNIQUE_DISCOUNT_FORMAT) {
            return strtoupper($first_name . $uniqueNumber);
        }

        $uniqueCode = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 4);

        return strtoupper($uniqueCode . $uniqueNumber);
    }
}