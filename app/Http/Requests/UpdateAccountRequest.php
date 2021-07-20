<?php

/**
 * ClnkGO
 *
 * @copyright   Copyright (c) 2021, BADDI Services. (https://baddi.info)
 */

namespace BADDIServices\ClnkGO\Http\Requests;

use App\Models\User;
use BADDIServices\ClnkGO\Models\Setting;
use BADDIServices\ClnkGO\Rules\AccountPasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
            User::FIRST_NAME_COLUMN    => 'required|string|min:1',
            User::LAST_NAME_COLUMN     => 'required|string|min:1',
            User::EMAIL_COLUMN         => 'required|email',
            User::PHONE_COLUMN         => 'nullable|string|max:25',
            Setting::BRAND_NAME_COLUMN => 'nullable|string|min:1',
            Setting::CURRENCY_COLUMN   => 'nullable|string|max:10',
            'current_password'         => 'nullable|string|min:8',
            'confirm_password'         => 'nullable|string|min:8',
            User::PASSWORD_COLUMN      => ['nullable', 'string', 'min:8', 'required_with:current_password', 'same:confirm_password', new AccountPasswordRule()]
        ];
    }
}