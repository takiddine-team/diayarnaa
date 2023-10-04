<?php

namespace App\Http\Requests\Backend\TermsCondition;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTermsConditionsFormRequest extends FormRequest
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
            'term_title_ar' => 'required',
            'term_title_en' => 'required',
            'term_description_ar' => 'required',
            'term_description_en' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'term_title_ar.required' => ' عنوان الشروط باللغة العربية مطلوب',
            'term_title_en.required' => ' عنوان الشروط باللغة الانجليزية مطلوب',
            'term_description_ar.required' => ' وصف الشروط باللغة العربية مطلوب',
            'term_description_en.required' => ' وصف الشروط باللغة الانجليزية مطلوب',
            'status.required' => 'الحالة مطلوبة',
        ];
    }
}
