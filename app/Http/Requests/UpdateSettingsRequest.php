<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Requests;

use BADDIServices\SocialRocket\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSettingsRequest extends FormRequest
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
            Setting::PAYOUT_METHOD_COLUMN       => ['nullable', 'string', Rule::in(Setting::PAYOUT_METHODS)],
            Setting::NOTIFY_NEW_ACCOUNT_COLUMN  => ['nullable', 'integer', 'in:1,0'],
            Setting::NOTIFY_NEW_OREDR_COLUMN    => ['nullable', 'integer', 'in:1,0'],
        ];
    }
}