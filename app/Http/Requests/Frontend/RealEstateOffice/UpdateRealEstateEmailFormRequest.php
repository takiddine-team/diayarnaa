<?php

namespace App\Http\Requests\Frontend\RealEstateOffice;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRealEstateEmailFormRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',

            'old_email' => [
                'required',
                Rule::exists('users', 'email')
                    ->where('id', Auth::guard('user')->user()->id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'old_email.required' => @trans('validation.OldEmailRequired'),
            'old_email.email' => @trans('validation.OldEmailVaild'),
            'old_email.exists' => @trans('validation.OldEmailExists'),
            'email.required' => @trans('validation.email'),
            'email.email' => @trans('validation.VaildEmail'),
            'email.unique' => @trans('validation.UniqueEmail'),
        ];
    }
}
