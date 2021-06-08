<?php

namespace App\Http\Requests\Webhooks;

use Illuminate\Foundation\Http\FormRequest;

class DeleteStoreRequest extends FormRequest
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
            'shop_id'               => ['required', 'integer'],
            'shop_domain'           => ['required', 'string'],
            'data_request'          => ['nullable', 'array'],
            'customer'              => ['nullable', 'array'],
            'customer_email'        => ['nullable', 'email'],
            'orders_requested'      => ['nullable', 'array'],
            'orders_requested.*'    => ['nullable', 'integer'],
            'orders_to_redact'      => ['nullable', 'array'],
            'orders_to_redact.*'    => ['nullable', 'integer'],
        ];
    }
}