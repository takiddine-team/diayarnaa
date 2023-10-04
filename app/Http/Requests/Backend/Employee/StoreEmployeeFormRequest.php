<?php

namespace App\Http\Requests\Backend\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreEmployeeFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return Auth::check();
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
            'name' => 'required|unique:admins,name',
            'type' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|unique:admins,phone',
           

        ];
    }

    public function messages()
    {
        return [

             'type.required' => 'النوع مطلوب !!!',

            'name.required' => 'الاسم مطلوب !!!',
            'name.unique' => 'الاسم موجود مسبقاً !!!',

            'email.required' => 'البريد الالكتروني مطلوب !!!',
            'email.email' => ' البريد الالكتروني غير صحيح !!!',
            'email.unique' => ' البريد الالكتروني موجود مسبقا !!!',

            'phone.required' => 'الهاتف مطلوب !!!',
            'phone.unique' => ' الهاتف موجود مسبقا !!!',

         

            'password.required' => ' كلمة المرور مطلوبة !!!',
            'password.min' => ' كلمة المرور يجب ان تكون اكثر من 8 احرف !!!',
            'password.confirmed' => ' كلمة المرور غير متطابقة !!!',

           



        ];
    }
}
