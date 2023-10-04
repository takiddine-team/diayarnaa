<?php

namespace App\Http\Requests\Backend\Job;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateJobFormRequest extends FormRequest
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
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'expiry_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file' => 'mimes:pdf,doc,docx|max:2048',
            'status' => 'required|integer|numeric'
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
            'title_ar.required' => 'العنوان بالعربية مطلوب',
            'title_en.required' => 'العنوان بالانجليزية مطلوب',
            'description_ar.required' => 'الوصف بالعربية مطلوب',
            'description_en.required' => 'الوصف بالانجليزية مطلوب',
            'expiry_date.required' => 'تاريخ الانتهاء مطلوب',
            'expiry_date.date_format' => 'تاريخ الانتهاء يجب ان يكون بالتنسيق الصحيح',
            'expiry_date.after_or_equal' => 'تاريخ الانتهاء يجب ان يكون بعد او يساوي تاريخ اليوم',

            'image.image' => 'الصورة يجب ان تكون صورة',
            'image.mimes' => 'الصورة يجب ان تكون من نوع jpeg,png,jpg,gif,svg',
            'image.max' => 'الصورة يجب ان لا تزيد عن 2 ميجا',

            'file.mimes' => 'الملف يجب ان يكون من نوع pdf,doc,docx',
            'file.max' => 'الملف يجب ان لا يزيد عن 2 ميجا',

            'status.required' => 'الحالة مطلوبة',
            'status.integer' => 'الحالة يجب ان تكون رقم',
            'status.numeric' => 'الحالة يجب ان تكون رقم',
            

        ];
    }
}
