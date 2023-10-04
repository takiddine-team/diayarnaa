<?php

namespace App\Http\Requests\Backend\FeatureType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreFeatureTypeFormRequest extends FormRequest
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
            'name_en' => 'required|unique:feature_types,name_en',
            'name_ar' => 'required|unique:feature_types,name_ar',
            'status' => 'required',
            
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
            'name_en.required' => 'اسم الميزة باللغة الانجليزية مطلوب',
            'name_en.unique' => 'اسم الميزة باللغة الانجليزية موجود مسبقا',
            'name_ar.required' => 'اسم الميزة باللغة العربية مطلوب',
            'name_ar.unique' => ' اسم الميزة باللغة العربية موجود مسبقا',
            'status.required' => 'حالة الميزة مطلوبة',
        ];
    }
}
