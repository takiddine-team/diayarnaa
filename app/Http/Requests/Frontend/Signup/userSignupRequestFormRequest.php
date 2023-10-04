<?php

namespace App\Http\Requests\Frontend\Signup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class userSignupRequestFormRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        // dd($this->request);
        if (isset($this->user_type) && $this->user_type == 1) {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'user_type' => 'required|numeric|integer',
                'phone' => 'required|unique:users,phone',
                'office_phone' => 'required|unique:users,office_phone',
                'diyarnaa_country_id' => 'required',
                'diyarnaa_city_id' => 'required',
                'diyarnaa_region_id' => 'required',

                'license_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        } else {
            return [
                'name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'user_type' => 'required|numeric|integer',
                'phone' => 'required|unique:users,phone',
                'diyarnaa_country_id' => 'required',
                'diyarnaa_city_id' => 'required',
                'diyarnaa_region_id' => 'required',

                'license_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => @trans('validation.name'),
            'name.unique' => @trans('validation.UniqueName'),

            'email.required' => @trans('validation.email'),
            'email.email' => @trans('validation.VaildEmail'),
            'email.unique' => @trans('validation.UniqueEmail'),

            'phone.required' => @trans('validation.phone'),
            'phone.unique' => @trans('validation.UniquePhone'),

            'country_id.required' => @trans('validation.diyarnaa_country_id'),


            'password.required' => @trans('validation.Password'),
            'password.min' => @trans('validation.PasswordMin'),
            'password.confirmed' => @trans('validation.PasswordConfirmed'),

            'user_type.required' => @trans('validation.UserType'),
            'user_type.integer' => @trans('validation.UserTypeInteger'),
            'user_type.numeric' => @trans('validation.UserTypeNumeric'),


            'license_image.required' => @trans('validation.LicenseImage'),
            'license_image.image' => @trans('validation.LicenseImageValidate'),
            'license_image.mimes' => @trans('validation.LicenseImageValidateType'),

            'profile_image.image' => @trans('validation.ProfileImage'),
            'profile_image.mimes' => @trans('validation.ProfileImageMimes'),
            'profile_image.max' => @trans('validation.ProfileImageMax'),


            'last_name.required' => @trans('validation.last_name'),


            'office_phone.required' => @trans('validation.OfficePhone'),
            'office_phone.unique' => @trans('validation.OfficePhoneUnique'),

            'diyarnaa_country_id.required' => @trans('validation.diyarnaa_country_id'),
            'diyarnaa_city_id.required' => @trans('validation.SelectState'),
            'diyarnaa_region_id.required' => @trans('validation.SelectRegion'),




        ];
    }
}
