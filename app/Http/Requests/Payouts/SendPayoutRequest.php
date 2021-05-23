<?php

namespace App\Http\Requests\Payouts;

use BADDIServices\SocialRocket\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SendPayoutRequest extends FormRequest
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
            'reference'         => ['required', 'string'],
            'payout_method'     => ['required', 'string', Rule::in(Setting::PAYOUT_METHODS)],
            'additional_info'   => ['nullable', 'string'],
        ];
    }
}