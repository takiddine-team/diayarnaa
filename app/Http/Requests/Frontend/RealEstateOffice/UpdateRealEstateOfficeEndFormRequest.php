<?php

namespace App\Http\Requests\Frontend\RealEstateOffice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRealEstateOfficeEndFormRequest extends FormRequest
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


        if (Auth::guard('user')->user()->user_type == 'Real Estate Office') {
            $rules = [
                'phone' => 'required|unique:users,phone,' . $this->id,
                'office_phone' => 'required|unique:users,office_phone,' . $this->id,
                'diyarnaa_city_id' => 'required',
                'diyarnaa_region_id' => 'required',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        } elseif (Auth::guard('user')->user()->user_type == 'Real Estate Owner') {
            $rules = [
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        } else {
            $rules = [
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'diyarnaa_city_id' => 'required',
                'diyarnaa_region_id' => 'required',
            ];
        }



        return $rules;
    }


    public function messages()
    {
        return [
            'name.required' => @trans('validation.name'),
            'name.unique' => @trans('validation.UniqueName'),
            'phone.required' => @trans('validation.phone'),
            'phone.unique' => @trans('validation.UniquePhone'),
            'office_phone.required' => @trans('validation.OfficePhone'),
            'office_phone.unique' => @trans('validation.OfficePhoneUnique'),
            'diyarnaa_country_id.required' => @trans('validation.diyarnaa_country_id'),
            'diyarnaa_city_id.required' => @trans('validation.diyarnaa_city_id'),
            'diyarnaa_region_id.required' => @trans('validation.SelectRegion'),
            'profile_image.image' => @trans('validation.Images'),
            'profile_image.mimes' => @trans('validation.ImagesMimes'),
            'profile_image.max' => @trans('validation.ImagesMax'),
            // 'profile_image.max' => 'صورة الملف الشخصي يجب ان لا تزيد عن 2048 كيلوبايت',
        ];
    }
}
