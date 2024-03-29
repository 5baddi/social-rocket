<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnalyticsRequest extends FormRequest
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
            'start-date'    =>  ['nullable', 'date', 'date_format:Y-m-d'],
            'end-date'      =>  ['nullable', 'date', 'date_format:Y-m-d'],
            'ap'            =>  ['nullable', 'integer'],
            'pp'            =>  ['nullable', 'integer'],
        ];
    }
}
