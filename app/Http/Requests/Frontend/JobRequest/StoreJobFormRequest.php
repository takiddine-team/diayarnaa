<?php

namespace App\Http\Requests\Frontend\JobRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobFormRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */

    public function messages()
    {
        return [
            'first_name.required' =>@trans('validation.name'),
            'last_name.required' =>@trans('validation.last_name'),
            'email.required' =>@trans('validation.Email'),
            'phone.required' =>@trans('validation.phone'),
            'file.required' =>@trans('validation.File'),
            'file.mimes' => @trans('validation.FileMimes'),
            'file.max' => @trans('validation.FileMax'),
        ];
    }
}
