<?php

namespace App\Http\Requests\Webhooks;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'id'                => ['required', 'integer'],
            'created_at'        => ['required', 'datetime'],
            'updated_at'        => ['required', 'datetime'],
            'closed_at'         => ['nullable', 'datetime'],
            'total_price'       => ['required', 'number'],
            'test'              => ['required', 'boolean'],
        ];
    }
}