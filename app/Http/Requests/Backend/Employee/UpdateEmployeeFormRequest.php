<?php

namespace App\Http\Requests\Backend\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateEmployeeFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('super_admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:admins,name,' . $this->id,
            'email' => 'required|email|unique:admins,email,' . $this->id,
            'phone' => 'required|unique:admins,phone,' . $this->id,
            'password' => 'nullable|string|min:8|confirmed',
            'type' => 'required',

        ];
    }

    public function messages()
    {

        return [
            'name.required' => 'الاسم مطلوب !!!',
            'name.unique' => 'الاسم موجود مسبقا !!!',

            'email.required' => 'البريد الالكتروني مطلوب !!!',
            'email.email' => ' البريد الالكتروني غير صحيح !!!',
            'email.unique' => ' البريد الالكتروني موجود مسبقا !!!',

            'phone.required' => 'الهاتف مطلوب !!!',
            'phone.unique' => ' الهاتف موجود مسبقا !!!',

            'type.required' => 'النوع مطلوب !!!',
            'password.required' => ' كلمة المرور مطلوبة !!!',
            'password.min' => ' كلمة المرور يجب ان تكون اكثر من 8 احرف !!!',
            'password.confirmed' => ' كلمة المرور غير متطابقة !!!',




        ];
    }
}
