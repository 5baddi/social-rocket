<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Requests\Oauth;

use BADDIServices\SocialRocket\Common\FeatureList;
use BADDIServices\SocialRocket\Rules\RequiredIfFeatureEnabled;
use BADDIServices\SocialRocket\Rules\ValidateHCaptcha;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConnectShopRequest extends FormRequest
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
            'shop'                   =>  ['required', 'string'],
            'h-captcha-response'     =>  [new RequiredIfFeatureEnabled(FeatureList::HCAPTCHA), new ValidateHCaptcha()],
        ];
    }
}
