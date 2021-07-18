<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Services;

use BADDIServices\SocialRocket\Models\Store;
use Illuminate\Database\Eloquent\Collection;
use BADDIServices\SocialRocket\Models\Setting;
use BADDIServices\SocialRocket\Repositories\SettingRepository;

class SettingService extends Service
{
    /** @var array */
    public const CURRENCIES_LIST = [
        'ALL' => 'Albania Lek',
        'AFN' => 'Afghanistan Afghani',
        'ARS' => 'Argentina Peso',
        'AWG' => 'Aruba Guilder',
        'AUD' => 'Australia Dollar',
        'AZN' => 'Azerbaijan New Manat',
        'BSD' => 'Bahamas Dollar',
        'BBD' => 'Barbados Dollar',
        'BDT' => 'Bangladeshi taka',
        'BYR' => 'Belarus Ruble',
        'BZD' => 'Belize Dollar',
        'BMD' => 'Bermuda Dollar',
        'BOB' => 'Bolivia Boliviano',
        'BAM' => 'Bosnia and Herzegovina Convertible Marka',
        'BWP' => 'Botswana Pula',
        'BGN' => 'Bulgaria Lev',
        'BRL' => 'Brazil Real',
        'BND' => 'Brunei Darussalam Dollar',
        'KHR' => 'Cambodia Riel',
        'CAD' => 'Canada Dollar',
        'KYD' => 'Cayman Islands Dollar',
        'CLP' => 'Chile Peso',
        'CNY' => 'China Yuan Renminbi',
        'COP' => 'Colombia Peso',
        'CRC' => 'Costa Rica Colon',
        'HRK' => 'Croatia Kuna',
        'CUP' => 'Cuba Peso',
        'CZK' => 'Czech Republic Koruna',
        'DKK' => 'Denmark Krone',
        'DOP' => 'Dominican Republic Peso',
        'XCD' => 'East Caribbean Dollar',
        'EGP' => 'Egypt Pound',
        'SVC' => 'El Salvador Colon',
        'EEK' => 'Estonia Kroon',
        'EUR' => 'Euro Member Countries',
        'FKP' => 'Falkland Islands (Malvinas) Pound',
        'FJD' => 'Fiji Dollar',
        'GHC' => 'Ghana Cedis',
        'GIP' => 'Gibraltar Pound',
        'GTQ' => 'Guatemala Quetzal',
        'GGP' => 'Guernsey Pound',
        'GYD' => 'Guyana Dollar',
        'HNL' => 'Honduras Lempira',
        'HKD' => 'Hong Kong Dollar',
        'HUF' => 'Hungary Forint',
        'ISK' => 'Iceland Krona',
        'INR' => 'India Rupee',
        'IDR' => 'Indonesia Rupiah',
        'IRR' => 'Iran Rial',
        'IMP' => 'Isle of Man Pound',
        'ILS' => 'Israel Shekel',
        'JMD' => 'Jamaica Dollar',
        'JPY' => 'Japan Yen',
        'JEP' => 'Jersey Pound',
        'KZT' => 'Kazakhstan Tenge',
        'KPW' => 'Korea (North) Won',
        'KRW' => 'Korea (South) Won',
        'KGS' => 'Kyrgyzstan Som',
        'LAK' => 'Laos Kip',
        'LVL' => 'Latvia Lat',
        'LBP' => 'Lebanon Pound',
        'LRD' => 'Liberia Dollar',
        'LTL' => 'Lithuania Litas',
        'MKD' => 'Macedonia Denar',
        'MYR' => 'Malaysia Ringgit',
        'MUR' => 'Mauritius Rupee',
        'MXN' => 'Mexico Peso',
        'MNT' => 'Mongolia Tughrik',
        'MZN' => 'Mozambique Metical',
        'NAD' => 'Namibia Dollar',
        'NPR' => 'Nepal Rupee',
        'ANG' => 'Netherlands Antilles Guilder',
        'NZD' => 'New Zealand Dollar',
        'NIO' => 'Nicaragua Cordoba',
        'NGN' => 'Nigeria Naira',
        'NOK' => 'Norway Krone',
        'OMR' => 'Oman Rial',
        'PKR' => 'Pakistan Rupee',
        'PAB' => 'Panama Balboa',
        'PYG' => 'Paraguay Guarani',
        'PEN' => 'Peru Nuevo Sol',
        'PHP' => 'Philippines Peso',
        'PLN' => 'Poland Zloty',
        'QAR' => 'Qatar Riyal',
        'RON' => 'Romania New Leu',
        'RUB' => 'Russia Ruble',
        'SHP' => 'Saint Helena Pound',
        'SAR' => 'Saudi Arabia Riyal',
        'RSD' => 'Serbia Dinar',
        'SCR' => 'Seychelles Rupee',
        'SGD' => 'Singapore Dollar',
        'SBD' => 'Solomon Islands Dollar',
        'SOS' => 'Somalia Shilling',
        'ZAR' => 'South Africa Rand',
        'LKR' => 'Sri Lanka Rupee',
        'SEK' => 'Sweden Krona',
        'CHF' => 'Switzerland Franc',
        'SRD' => 'Suriname Dollar',
        'SYP' => 'Syria Pound',
        'TWD' => 'Taiwan New Dollar',
        'THB' => 'Thailand Baht',
        'TTD' => 'Trinidad and Tobago Dollar',
        'TRY' => 'Turkey Lira',
        'TRL' => 'Turkey Lira',
        'TVD' => 'Tuvalu Dollar',
        'UAH' => 'Ukraine Hryvna',
        'GBP' => 'United Kingdom Pound',
        'USD' => 'United States Dollar',
        'UYU' => 'Uruguay Peso',
        'UZS' => 'Uzbekistan Som',
        'VEF' => 'Venezuela Bolivar',
        'VND' => 'Viet Nam Dong',
        'YER' => 'Yemen Rial',
        'ZWD' => 'Zimbabwe Dollar'
    ];

    /** @var SettingRepository */
    private $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function all(): Collection
    {
        return $this->settingRepository->all();
    }
    
    public function findById(string $id): Setting
    {
        return $this->settingRepository->findById($id);
    }

    public function save(Store $store, $attributes): Setting
    {
        $attributes = collect([
            Setting::COMMISSION_AMOUNT_COLUMN       => $attributes[Setting::COMMISSION_AMOUNT_COLUMN] ?? null,
            Setting::COMMISSION_TYPE_COLUMN         => $attributes[Setting::COMMISSION_TYPE_COLUMN] ?? null,
            Setting::DISCOUNT_TYPE_COLUMN           => $attributes[Setting::DISCOUNT_TYPE_COLUMN] ?? null,
            Setting::DISCOUNT_FORMAT_COLUMN         => $attributes[Setting::DISCOUNT_FORMAT_COLUMN] ?? null,
            Setting::DISCOUNT_AMOUNT_COLUMN         => $attributes[Setting::DISCOUNT_AMOUNT_COLUMN] ?? null,
            Setting::COLOR_COLUMN                   => $attributes[Setting::COLOR_COLUMN] ?? null,
            Setting::BRAND_NAME_COLUMN              => $attributes[Setting::BRAND_NAME_COLUMN] ?? null,
            Setting::CURRENCY_COLUMN                => $attributes[Setting::CURRENCY_COLUMN] ?? null,
        ]);

        $filterAttributes = $attributes->filter(function($value, $key) {
            return $value !== null;
        });

        return $this->settingRepository->save($store->id, $filterAttributes->toArray());
    }
    
    public function savePayoutSetting(Store $store, $attributes): Setting
    {
        $attributes = collect([
            Setting::PAYOUT_METHODS_COLUMN          => $attributes[Setting::PAYOUT_METHODS_COLUMN] ?? null,
            Setting::NOTIFY_NEW_ACCOUNT_COLUMN      => $attributes[Setting::NOTIFY_NEW_ACCOUNT_COLUMN] ?? false,
            Setting::NOTIFY_NEW_OREDR_COLUMN        => $attributes[Setting::NOTIFY_NEW_OREDR_COLUMN] ?? false,
        ]);

        $filterAttributes = $attributes->filter(function($value, $key) {
            return $value !== null;
        });

        return $this->settingRepository->save($store->id, $filterAttributes->toArray());
    }
    
    public function saveIntegrationsSetting(Store $store, $attributes): Setting
    {
        $attributes = collect([
            Setting::AFFILIATE_FORM_COLUMN      => $attributes[Setting::AFFILIATE_FORM_COLUMN] ?? false,
            Setting::THANKYOU_PAGE_COLUMN       => $attributes[Setting::THANKYOU_PAGE_COLUMN] ?? false,
            Setting::PURCHASE_MAIL_COLUMN       => $attributes[Setting::PURCHASE_MAIL_COLUMN] ?? false,
            Setting::PURCHASE_MAIL_24H_COLUMN   => $attributes[Setting::PURCHASE_MAIL_24H_COLUMN] ?? false,
            Setting::PURCHASE_MAIL_48H_COLUMN   => $attributes[Setting::PURCHASE_MAIL_48H_COLUMN] ?? false,
            Setting::PURCHASE_MAIL_120H_COLUMN  => $attributes[Setting::PURCHASE_MAIL_120H_COLUMN] ?? false,
            Setting::CUSTOM_SHARE_TEXT_COLUMN   => $attributes[Setting::CUSTOM_SHARE_TEXT_COLUMN] ?? null,
        ]);

        $filterAttributes = $attributes->filter(function($value, $key) {
            return $value !== null;
        });

        return $this->settingRepository->save($store->id, $filterAttributes->toArray());
    }
}