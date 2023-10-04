<?php

namespace App\Http\Requests\Frontend\WebsiteBroker;

use Illuminate\Foundation\Http\FormRequest;

class WebsiteBrokerFormRequest extends FormRequest
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
            'last_name' => 'required',
            'email' => 'required|email|unique:website_brokers,email',
            'phone' => 'required|unique:website_brokers,phone',
            'diyarnaa_country_id' => 'required|exists:diyarnaa_countries,id',
            'diyarnaa_city_id' => 'required|exists:diyarnaa_cities,id',
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
            'last_name.required' => @trans('validation.last_name'),
            'email.required' => @trans('validation.email'),
            'email.email' => @trans('validation.VaildEmail'),
            'email.unique' => @trans('validation.UniqueEmail'),
            'phone.required' => @trans('validation.phone'),
            'phone.unique' => @trans('validation.UniquePhone'),
            'diyarnaa_country_id.required' => @trans('validation.advertisement_id'),
            'diyarnaa_country_id.exists' => @trans('validation.diyarnaa_country_id_exists'),
            'diyarnaa_city_id.required' => @trans('validation.diyarnaa_city_id'),
            'diyarnaa_city_id.exists' => @trans('validation.diyarnaa_city_id_exists'),
        ];
    }

   


}
