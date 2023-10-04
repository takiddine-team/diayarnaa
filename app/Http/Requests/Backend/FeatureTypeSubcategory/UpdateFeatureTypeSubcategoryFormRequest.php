<?php

namespace App\Http\Requests\Backend\FeatureTypeSubcategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateFeatureTypeSubcategoryFormRequest extends FormRequest
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
            'sub_category_id' => 'required',
            'feature_type_ids' => 'required',
            'category_id' => 'required',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'sub_category_id.required' => 'التصنيف الفرعي مطلوب',
            'feature_type_ids.required' => ' نوع الميزة مطلوب',
            'category_id.required' => 'التصنيف الرئيسي مطلوب',
        ];
    }
}
