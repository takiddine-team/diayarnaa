<?php

namespace App\Http\Requests\Backend\SubCategory;

use App\Models\SubCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSubCategoryFormRequest extends FormRequest
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

       $sub_category= SubCategory::where('category_id','=',$this->category_id)->where('name_ar','=',$this->name_ar)->where('name_en','=',$this->name_en)->first();
        if ( $sub_category) {
            return [
                'name_en' => 'required|unique:sub_categories,name_en',
                'name_ar' => 'required|unique:sub_categories,name_ar',
                'status' => 'required|integer|numeric',
                'category_id' => 'required|integer|numeric',
            ];
        } else {
            return [
                'name_en' => 'required',
                'name_ar' => 'required',
                'status' => 'required|integer|numeric',
                'category_id' => 'required|integer|numeric',
            ];
        }
        
      
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name_en.required' => 'العنوان بالعربي مطلوب',
            'name_ar.required' => 'العنوان بالانجليزي مطلوب',
            'status.required' => 'الحالة مطلوبة',
            'status.integer' => 'الحالة يجب ان تكون رقم',
            'status.numeric' => 'الحالة يجب ان تكون رقم',
            'category_id.required' => 'التصنيف الرئيسي مطلوب',
            'name_ar.unique' => 'العنوان بالعربي موجود مسبقا',
            'name_en.unique' => 'العنوان بالانجليزي موجود مسبقا',
        ];
    }
}
