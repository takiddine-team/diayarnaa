<?php

namespace App\Http\Requests\Backend\DiyarnaaCountry;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiyarnaaCountryRequestForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'flag' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|integer|numeric',
            'public_currency_id' => 'required',
            'name_en' => 'required|unique:diyarnaa_countries,name_en,' . $this->id,
            'name_ar' => 'required|unique:diyarnaa_countries,name_ar,' . $this->id,
            'country_code' => 'required',
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
            'country_code.required' => 'كود الدولة  مطلوب',
            'flag.mimes' => 'صورة العلم يجب ان تكون من نوع jpeg, png, jpg, gif, svg',
            'flag.max' => 'حجم صوره العلم يجب ان اقل من  2048 kilobytes',

            'image.mimes' => 'الصورة يجب ان تكون من نوع : jpeg, png, jpg, gif, svg',
            'image.max' => 'حجم الصورة يجب ان يكون اقل من 2048 kilobytes',

            'status.required' => 'الحالة مطلوبة',

            'currency_id.required' => 'العملة مطلوبة',

            'name_en.required' => 'الاسم بالانجليزي مطلوب',
            'name_en.unique' => 'الاسم بالانجليزي مسجل من قبل',

            'name_ar.required' => 'الاسم بالعربي مطلوب',
            'name_ar.unique' => 'الاسم بالعربي مسجل من قبل',
        ];
    }
}
