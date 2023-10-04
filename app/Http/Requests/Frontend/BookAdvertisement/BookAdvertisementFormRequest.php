<?php

namespace App\Http\Requests\Frontend\BookAdvertisement;

use Illuminate\Foundation\Http\FormRequest;

class BookAdvertisementFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'company_name_ar' => 'required',
            'company_name_en' => 'required',
            'diyarnaa_country_id' => 'required',
            'diyarnaa_city_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'license_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'phone' => 'required',
            'email' => 'required|email',

        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'company_name_ar.required' => @trans('validation.company_name_ar'),
            'company_name_en.required' => @trans('validation.company_name_en'),
            'diyarnaa_country_id.required' => @trans('validation.diyarnaa_country_id'),
            'diyarnaa_city_id.required' => @trans('validation.diyarnaa_city_id'),
            'image.required' => @trans('validation.ImagesRequired'),
            'image.image' => @trans('validation.Images'),
            'image.mimes' => @trans('validation.ImagesMimes'),
            'image.max' => @trans('validation.ImagesMax'),
            'license_image.required' => @trans('validation.license_image'),
            'license_image.image' => @trans('validation.LicenseImageValidate'),
            'license_image.mimes' => @trans('validation.LicenseImageValidateType'),
            'license_image.max' => @trans('validate.ProfileImageMax'),
            'title_ar.required' => @trans('validation.TitleAR'),
            'title_en.required' => @trans('validation.TitleEN'),
            'description_ar.required' => @trans('validation.DescriptionArRequired'),
            'description_en.required' => @trans('validation.DescriptionEnRequired'),
            'phone.required' => @trans('validation.phone'),
            'email.required' => @trans('validation.email'),
            'email.email' => @trans('validation.VaildEmail'),



        ];
    }
}
