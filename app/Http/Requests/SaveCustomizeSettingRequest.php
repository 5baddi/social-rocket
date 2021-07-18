<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Requests;

use BADDIServices\SocialRocket\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveCustomizeSettingRequest extends FormRequest
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
            'commission_type'   =>  ['required', 'string', Rule::in(Setting::COMMISSION_TYPES)],
            'discount_type'     =>  ['required', 'string', Rule::in(Setting::DISCOUNT_TYPES)],
            'discount_format'   =>  ['required', 'string', Rule::in(array_keys(Setting::DISCOUNT_FORMATS))],
            'commission_amount' =>  ['nullable', 'numeric'],
            'discount_amount'   =>  ['nullable', 'numeric'],
            'color'             =>  ['nullable', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        ];
    }
}
