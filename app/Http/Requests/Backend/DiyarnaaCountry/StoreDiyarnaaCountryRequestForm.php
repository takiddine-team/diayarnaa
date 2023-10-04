<?php

namespace App\Http\Requests\Backend\DiyarnaaCountry;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreDiyarnaaCountryRequestForm extends FormRequest
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
            'flag' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'public_country_id' => 'required',
            'status' => 'required|integer|numeric',
            'public_currency_id' => 'required',

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
            'flag.required' => 'العلم مطلوب',
            'flag.mimes' => 'صورة العلم يجب ان تكون من نوع jpeg, png, jpg, gif, svg',
            'flag.max' => 'حجم صوره العلم يجب ان اقل من  2048 kilobytes',

            'image.required' => 'الصورة مطلوبه',
            'image.mimes' => 'الصورة يجب ان تكون من نوع : jpeg, png, jpg, gif, svg',
            'image.max' => 'حجم الصورة يجب ان يكون اقل من 2048 kilobytes',

            'public_country_id.required' => 'الدولة مطلوبة',
            'status.required' => 'الحالة مطلوبة',

            'currency_id.required' => 'العملة مطلوبة',
        ];
    }
}
