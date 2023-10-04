<?php

namespace App\Http\Requests\Frontend\Chat;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreChatFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('user')->check();
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

            'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
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
            'details.required' =>@trans('front.DetailsRequired'),
            'file.file' =>@trans('front.FileNotCorrect'),
            'file.mimes' =>@trans('front.FileType'),
            'file.max' =>@trans('front.MaxFileSize'),

        ];
    }
}
