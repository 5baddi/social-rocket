<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Requests;

use BADDIServices\SocialRocket\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class UpdateIntegrationsSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Setting::AFFILIATE_FORM_COLUMN      => ['nullable', 'integer', 'in:1,0'],
            Setting::THANKYOU_PAGE_COLUMN       => ['nullable', 'integer', 'in:1,0'],
            Setting::PURCHASE_MAIL_COLUMN       => ['nullable', 'integer', 'in:1,0'],
            Setting::PURCHASE_MAIL_24H_COLUMN   => ['nullable', 'integer', 'in:1,0'],
            Setting::PURCHASE_MAIL_48H_COLUMN   => ['nullable', 'integer', 'in:1,0'],
            Setting::PURCHASE_MAIL_120H_COLUMN  => ['nullable', 'integer', 'in:1,0'],
        ];
    }
}