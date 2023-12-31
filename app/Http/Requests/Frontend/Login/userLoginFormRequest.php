<?php

namespace App\Http\Requests\Frontend\Login;

use Illuminate\Foundation\Http\FormRequest;

class userLoginFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];
    }


    public function messages()
    {
        return [
            'email.required' => @trans('validation.email'),
            'password.required' => @trans('validation.password'),
            'password.min' => @trans('validation.PasswordMin'),
        ];
    }
}
