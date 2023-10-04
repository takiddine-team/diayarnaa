<?php

namespace App\Http\Requests\Backend\InternalMail;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMailFormRequest extends FormRequest
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
            'details' => 'required',
            'email' => 'required',
            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => ' الايميل مطلوبه',
            'details.required' => ' التفاصيل مطلوبه',
            'file.file' => ' الملف غير صحيح',
            'file.mimes' => ' الملف يجب ان يكون من نوع pdf,doc,docx,jpg,jpeg,png',
            'file.max' => ' الملف يجب ان لا يزيد عن 2 ميجا',
            
        ];
    }
}
