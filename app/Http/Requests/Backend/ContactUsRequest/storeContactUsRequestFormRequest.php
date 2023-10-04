<?php

namespace App\Http\Requests\Backend\ContactUsRequest;

use Illuminate\Foundation\Http\FormRequest;

class storeContactUsRequestFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:255',

            //
        ];


    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages(){
        return [
            'name.required' => @trans('validation.name'),
            'email.required' =>@trans('validation.email'),
            'phone.required' =>@trans('validation.phone'),
            'subject.required' =>@trans('validation.subject'),
            'message.required' =>@trans('validation.message'),

            //
        ];
    }
}
