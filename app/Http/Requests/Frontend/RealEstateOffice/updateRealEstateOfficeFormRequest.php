<?php

namespace App\Http\Requests\Frontend\RealEstateOffice;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRealEstateOfficeFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('user')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        dd(Auth::guard('user')->user()->user_type);

        /////==================== Real222 Estate Office ====================/////
        if (Auth::guard('user')->user()->user_type == 'Real Estate Office') {
            return [
                'phone' => 'required|unique:users,phone,' . $this->id,
                'office_phone' => 'required|unique:users,office_phone,' . $this->id,
                'diyarnaa_city_id' => 'required',
                'diyarnaa_region_id' => 'required',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        } else if (Auth::guard('user')->user()->user_type == 'Real Estate Owner') {
            return [
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        }
    }

    public function messages()
    {

        // test

        return [
            'name.required' =>@trans('validation.name'),
            'name.unique' =>@trans('validation.UniqueName'),
            'phone.required' =>@trans('validation.phone'),
            'phone.unique' =>@trans('validation.UniquePhone'),
            'office_phone.required' =>@trans('validation.OfficePhone'),
            'office_phone.unique' =>@trans('validation.OfficePhoneUnique'),
            'diyarnaa_city_id.required' =>@trans('validation.diyarnaa_city_id'),
            'diyarnaa_region_id.required' =>@trans('validation.diyarnaa_region_id'),
            'profile_image.image' =>@trans('validation.ProfileImage'),
            'profile_image.mimes' =>@trans('validation.ProfileImageMimes'),
            'profile_image.max' => @trans('validation.ProfileImageMax'),

        ];
    }
}
