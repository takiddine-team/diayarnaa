<?php

namespace App\Http\Requests\Frontend\RealEstateOffice;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRealEstatePasswordFormRequest extends FormRequest
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
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'old_password.required' =>@trans('validation.OLdPassword'),
            'password.min' =>@trans('validation.PasswordMin'),
            'password.confirmed' =>@trans('validation.PasswordConfirmed'),
            'password.required' =>@trans('validation.Password'),
        ];
    }
}
