<?php

namespace App\Http\Requests\Frontend\EnqueryRequest;

use Illuminate\Foundation\Http\FormRequest;

class EnqueryRequestFormRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'message' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name.required' => @trans('validation.name'),
            'email.required' => @trans('validation.email'),
            'email.email' => @trans('validation.VaildEmail'),
            'phone.required' => @trans('validation.phone'),
            'message.required' => @trans('validation.message'),
            'advertisement_id.required' => @trans('validation.advertisement_id'),
        ];
    }
}
