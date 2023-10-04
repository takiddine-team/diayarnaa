<?php

namespace App\Http\Requests\Backend\AboutUsImage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAboutUsImageFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar' => 'required',
            'name_en' => 'required',
            'job_title_ar' => 'required',
            'job_title_en' => 'required',
            'background_ar' => 'required',
            'background_en' => 'required',
            'some_of_projects_ar' => 'required',
            'some_of_projects_en' => 'required',
            'contact' => 'required',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:4048',
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => 'الاسم بالعربي مطلوب!!!',
            'name_en.required' => 'الإسم بالإنجليزي مطلوب!!!',

            'job_title_ar.required' => 'عنوان الوظيفة بالعربي مطلوب!!!',
            'job_title_en.required' => 'عنوان الوظيفة بالإنجليزي مطلوب!!!',

            'background_ar.required' => 'الخلفية بالعربي مطلوب!!!',
            'background_en.required' => 'الخلفية بالإنجليزي مطلوب!!!',

            'some_of_projects_ar.required' => 'بعض المشاريع بالعربي مطلوب!!!',
            'some_of_projects_en.required' => 'بعض المشاريع بالإنجليزي مطلوب!!!',

            'contact.required' => 'التواصل مطلوب!!!',

            'image.required' => 'الصورة مطلوبه !!!',
            'image.mimes' => 'نوع الصورة يجب ان يكون (jpeg,png,jpg,gif,svg)',
            'image.max' => 'حجم الصوره يجب ان يكون اقل من : (4 MB) !!',
        ];
    }
}
