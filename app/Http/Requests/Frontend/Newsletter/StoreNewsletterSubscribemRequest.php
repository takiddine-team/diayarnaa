<?php

namespace App\Http\Requests\Frontend\Newsletter;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsletterSubscribemRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email_subscribe' => 'required|email',
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
            'email_subscribe.required' => @trans('validation.email_subscribe'),
            'email_subscribe.unique' => @trans('validation.email_subscribe_unique'),
            'email_subscribe.email' =>@trans('validation.email_subscribe_valid'),
        ];
    }
}
