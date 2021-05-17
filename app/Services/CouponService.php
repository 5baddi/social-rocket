<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use Illuminate\Support\Str;
use BADDIServices\SocialRocket\Models\Store;
use BADDIServices\SocialRocket\Models\Setting;

class CouponService extends Service
{
    public function getScriptTag(string $coupon, float $discount = Setting::DFEAULT_DISCOUNT, string $format = Setting::FIXED_TYPE)
    {
        $html = '<div class="section__content srow">
            <div class="section__content__column scolumn-text" style="width: 65%;">
            <div class="text-container">
                <h2 id="offer_header" style="font-weight: 600; font-size: 23px; color: rgb(0, 0, 0);"> You can make money promoting our products!</h2>
                <p class="os-step__description">
                    Simply share the discount code we created just for you 
                    <svg class="sloading" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: none; vertical-align: middle;" width="20px" height="20px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                        <circle cx="50" cy="50" fill="none" stroke="#2c407d" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138" transform="rotate(336.538 50 50)">
                        <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"> </animateTransform>
                        </circle>
                    </svg>
                    <span class="scode" id="scode" style="font-weight: bold;">{coupon}</span> and receive 
                    <b style="font-weight: bold;">
                        <svg class="sloading_merchant_commission" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(255, 255, 255); display: none; vertical-align: middle;" width="20px" height="20px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                        <circle cx="50" cy="50" fill="none" stroke="#2c407d" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138" transform="rotate(336.538 50 50)">
                            <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
                        </circle>
                        </svg>
                        <span class="smerchant_commission" style="font-weight: bold;"> {amount} </span>
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
                        <p style="">Share now and start earning <img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/img/icon-arrow-bottom2.png" alt="Arrow pointing down" style="display: inline-block; vertical-align: middle; width: 13px; "> </p>
                        </div>
                    </li>
                    <li class="payment-method-list__item" style="text-align: center; ">
                        <div style="width: 100%;"><a style="color: #fff; display: inline-block; padding: 8px 16px 8px 13px; background-color: #3C57B3; border-radius: 30px; cursor: pointer; width: 88%;" onclick="window.shareFacebook()"> <img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/img/facebook.svg" alt="Facebook logo" style="width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle;"> Share </a> </div>
                    </li>
                    <li class="payment-method-list__item" style="text-align: center; ">
                        <div style="width: 100%;"><a style="color: #40ABEE; font-weight: 600; display: inline-block; padding: 8px 15px 8px 12px; background-color: #000000; border-radius: 30px; cursor: pointer; width: 88%;" onclick="window.shareTwitter()"><img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/img/twitter.svg" alt="Twitter logo" style="width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle; ">Share</a> </div>
                    </li>
                    <li class="payment-method-list__item" style="text-align: center; ">
                        <div style="width: 100%;">
                        <a style="color: #fff; display: inline-block; padding: 8px 16px 8px 13px; background-color: #8D9DAD; border-radius: 30px; cursor: pointer; width: 88%;" onclick="window.copyLink()">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle;" xml:space="preserve">
                                <g>
                                    <path d="M464,64h-48V48c0-26.51-21.49-48-48-48H48C21.49,0,0,21.49,0,48v320c0,26.51,21.49,48,48,48h16v48c0,26.51,21.49,48,48,48 h352c26.51,0,48-21.49,48-48V112C512,85.49,490.51,64,464,64z M64,112v272H48c-8.837,0-16-7.163-16-16V48c0-8.837,7.163-16,16-16 h320c8.837,0,16,7.163,16,16v16H112C85.49,64,64,85.49,64,112z M480,464c0,8.837-7.163,16-16,16H112c-8.837,0-16-7.163-16-16V112 c0-8.837,7.163-16,16-16h352c8.837,0,16,7.163,16,16V464z" fill="#fff"></path>
                                </g>
                            </svg>
                            Copy code
                        </a>
                        </div>
                    </li>
                </ul>
                <input class="smerchant_name" type="hidden" value="Harper"> <input class="smerchant_discount" type="hidden" value="10%"> <input class="samount_code" type="hidden" value="10%"> <input class="smerchant_store" type="hidden" value="Social Rocket Store"> 
            </div>
            </div>
        </div>';

        $html = Str::replace('{coupon}', $coupon, $html);

        return $html;
    }

    public function getDiscount(float $amount, string $type)
    {

    }

    public function generateDiscountCode(Store $store, string $first_name): string
    {
        $store->load('setting');

        /** @var Setting */
        $setting = $store->setting;

        $uniqueNumber = substr(uniqid(mt_rand()), 0, 6);

        if (is_null($setting) || $setting->discount_amount === Setting::UNIQUE_DISCOUNT_FORMAT) {
            return strtoupper($first_name . $uniqueNumber);
        }

        $uniqueCode = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 4);

        return strtoupper($uniqueCode . $uniqueNumber);
    }
}