<?php

namespace App\Http\Requests\Backend\PrivacyPolicy;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePrivacyPolicyFormRequest extends FormRequest
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
            'privacy_title_ar' => 'required',
            'privacy_title_en' => 'required',
            'privacy_description_ar' => 'required',
            'privacy_description_en' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'privacy_title_ar.required' => 'العنوان بالعربي مطلوب',
            'privacy_title_en.required' => 'العنوان بالانجليزي مطلوب',
            'privacy_description_ar.required' => 'الوصف بالعربي مطلوب ',
            'privacy_description_en.required' => 'الوصف بالانجليزي مطلوب ',
            'status.required' => 'الحالة مطلوبة',
        ];
    }
}
