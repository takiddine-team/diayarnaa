<?php

namespace App\Http\Requests\Backend\Newsletter;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class NewsletterRequest extends FormRequest
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
            'link' => 'nullable|url',
            'newsletter' => 'required',
            'title' => 'required',
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
            'newsletter.required' => 'Please enter newsletter',
            
            'title.required' => 'Please enter title',
            'link.url' => 'Link must be URL'
        ];
    }
}
