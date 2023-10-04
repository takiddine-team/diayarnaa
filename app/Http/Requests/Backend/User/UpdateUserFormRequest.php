<?php

namespace App\Http\Requests\Backend\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserFormRequest extends FormRequest
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
        if ($this->user_type == 1) {
            return [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $this->id,
                'phone' => 'required|unique:users,phone,' . $this->id,
                'password' => 'nullable|string|min:8|confirmed',
                'user_type' => 'required|numeric|integer',
                'office_phone' => 'required|unique:users,office_phone,' . $this->id,
                'diyarnaa_country_id' => 'required',
                'diyarnaa_city_id' => 'required',
                'status' => 'required|numeric|integer',
                'license_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'expire_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            ];
        } else {

            return [
                'name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email,' . $this->id,
                'password' => 'nullable|string|min:8|confirmed',
                'user_type' => 'required|numeric|integer',
                'phone' => 'required|unique:users,phone,' . $this->id,
                'diyarnaa_country_id' => 'required',
                'diyarnaa_city_id' => 'required',
                'status' => 'required|numeric|integer',
                'license_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        }
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

            'country_id.required' => ' الدولة مطلوبة !!!',

            'year.required' => ' السنة مطلوبة !!!',
            'year.integer' => ' السنة يجب ان تكون رقم !!!',

            'password.required' => ' كلمة المرور مطلوبة !!!',
            'password.min' => ' كلمة المرور يجب ان تكون اكثر من 8 احرف !!!',
            'password.confirmed' => ' كلمة المرور غير متطابقة !!!',

            'user_type.required' => ' نوع المستخدم مطلوب !!!',
            'user_type.integer' => ' نوع المستخدم يجب ان يكون رقم !!!',
            'user_type.numeric' => ' نوع المستخدم يجب ان يكون رقم !!!',

            'status.required' => 'الحالة مطلوبة !!!',
            'status.integer' => ' الحالة يجب ان تكون رقم !!!',
            'status.numeric' => ' الحالة يجب ان تكون رقم !!!',

            'license_image.required' => ' صورة الرخصة مطلوبة !!!',
            'license_image.image' => ' صورة الرخصة يجب ان تكون صورة !!!',
            'license_image.mimes' => ' صورة الرخصة يجب ان تكون من نوع jpeg,png,jpg,gif,svg !!!',

            'profile_image.image' => ' صورة الملف الشخصي يجب ان تكون صورة !!!',
            'profile_image.mimes' => ' صورة الملف الشخصي يجب ان تكون من نوع jpeg,png,jpg,gif,svg !!!',
            'profile_image.max' => ' صورة الملف الشخصي يجب ان لا تزيد عن 2048 كيلوبايت !!!',

            'expire_date.required' => ' تاريخ صلاحية الحساب مطلوب !!!',
            'expire_date.date' => ' تاريخ صلاحية الحساب يجب ان يكون تاريخ !!!',
            'expire_date.after_or_equal' => ' تاريخ صلاحية الحساب يجب ان يكون اكبر من او يساوي تاريخ اليوم !!!',

            'last_name.required' => ' الاسم الاخير مطلوب !!!',


            'office_phone.required' => ' رقم الهاتف المكتبي مطلوب !!!',
            'office_phone.unique' => ' رقم الهاتف المكتبي موجود مسبقا !!!',
            'diyarnaa_country_id.required' => 'الدولة مطلوبة !!!',
            'diyarnaa_city_id.required' => ' المدينة مطلوبة !!!',

        ];
    }
}
