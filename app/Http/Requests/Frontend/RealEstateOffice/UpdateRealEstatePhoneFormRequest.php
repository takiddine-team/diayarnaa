<?php

namespace App\Http\Requests\Frontend\RealEstateOffice;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRealEstatePhoneFormRequest extends FormRequest
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
            'old_phone' => 'required',
            'phone' => 'required|min:8|unique:users,phone,' . Auth::guard('user')->user()->id,
        ];
    }

    public function messages()
    {
        return [
            'old_phone.required' =>@trans('validation.OldPhoneNumber'),
            'phone.min' =>@trans('validation.PhoneMin'),
            'phone.required' =>@trans('validation.phone'),
            'phone.unique' =>@trans('validation.UniquePhone'),

        ];
    }
}
