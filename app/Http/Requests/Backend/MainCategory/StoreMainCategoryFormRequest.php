<?php

namespace App\Http\Requests\Backend\MainCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMainCategoryFormRequest extends FormRequest
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
            'name_en' => 'required|unique:main_categories,name_en',
            'name_ar' => 'required|unique:main_categories,name_ar',
            'status' => 'required|in:1,2',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(){
        return [
            'name_en.required' => 'العنوان بالعربي مطلوب',
            'name_ar.required' => 'العنوان بالانجليزي مطلوب',
            'name_ar.unique' => 'العنوان بالانجليزي موجود مسبقا',
            'name_en.unique' => 'العنوان بالعربي موجود مسبقا',
            'status.required' => 'الحالة مطلوبة',
        ];
    }
}
