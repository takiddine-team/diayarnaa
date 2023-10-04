<?php

namespace App\Http\Requests\Backend\Target;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTargetRequestForm extends FormRequest
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
            'name_en' => 'required|unique:targets,name_en,'.$this->id,
            'name_ar' => 'required|unique:targets,name_ar,'.$this->id,
            'status' => 'required|integer|numeric',
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
            'name_en.required' => ' الاسم باللغة الانجليزية مطلوب',
            'name_ar.required' => ' الاسم باللغة العربية مطلوب',

            'status.required' => 'الحالة مطلوبة',
            'status.integer' => ' الحالة يجب ان تكون رقم',
            'status.numeric' => ' الحالة يجب ان تكون رقم',

            'name_en.unique' => ' الاسم باللغة الانجليزية موجود مسبقا',
            'name_ar.unique' => ' الاسم باللغة العربية موجود مسبقا',
            
        ];
    }
}
