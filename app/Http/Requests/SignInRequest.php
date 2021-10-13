<?php

/**
 * Social Rocket
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\SocialRocket\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use BADDIServices\SocialRocket\Rules\ValidateHCaptcha;
use Illuminate\Validation\Rule;

class SignInRequest extends FormRequest
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
            User::EMAIL_COLUMN         => 'required|email',
            User::PASSWORD_COLUMN      => 'required|string',
            'h-captcha-response'       =>  [Rule::requiredIf(env('HCAPTCHA_ENABLED')), new ValidateHCaptcha()],
        ];
    }
}
