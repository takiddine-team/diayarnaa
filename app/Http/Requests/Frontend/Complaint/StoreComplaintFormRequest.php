<?php

namespace App\Http\Requests\Frontend\Complaint;

use Illuminate\Foundation\Http\FormRequest;

class StoreComplaintFormRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'first_name' => 'required',
            // 'last_name' => 'required',
            // 'email' => 'required|string|email|max:255',
            // 'subject' => 'required',
            'description' => 'required|string',
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
            // 'first_name.required' => 'الاسم الاول مطلوب',
            // 'last_name.required' => ' الاسم الاخير مطلوب',
            // 'email.required' => ' البريد الالكتروني مطلوب',
            // 'subject.required' => ' الموضوع مطلوب',
            'description.required' => @trans('validation.DescriptionRequired'),
        ];
    }
}
