<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Requests\Admin\Settings;

use Illuminate\Foundation\Http\FormRequest;

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
            // 'app_name'              => ['required', 'string', 'min:1'],
            'support_email'         => ['nullable', 'email'],
            'help_url'              => ['nullable', 'url'],
            'setup_guide'           => ['nullable', 'url'],
            'api_key'               => ['required', 'string'],
            'client_secret'         => ['required', 'string'],
        ];
    }
}