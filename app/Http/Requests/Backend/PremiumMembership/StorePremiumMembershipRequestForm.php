<?php

namespace App\Http\Requests\Backend\PremiumMembership;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePremiumMembershipRequestForm extends FormRequest
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
        if($this->unlimited_status == 1){
            return [
                'name_en' => 'required',
                'name_ar' => 'required',
                'description_en' => 'required',
                'description_ar' => 'required',
                'price' => 'required|numeric',
                'number_days_ad' => 'required|integer|numeric',
                'number_days_membership' => 'required|integer|numeric',
                'status' => 'required|integer|numeric',
                'featured_type' => 'required|integer|numeric',
                'user_type' => 'required|integer|numeric',
                'unlimited_status' => 'required|integer|numeric',
            ];
        }else{
            return [
                'name_en' => 'required',
                'name_ar' => 'required',
                'description_en' => 'required',
                'description_ar' => 'required',
                'price' => 'required|numeric',
                'number_days_ad' => 'required|integer|numeric',
                'number_days_membership' => 'required|integer|numeric',
                'number_of_ads' => 'required|integer|numeric',
                'status' => 'required|integer|numeric',
                'featured_type' => 'required|integer|numeric',
                'user_type' => 'required|integer|numeric',
                'unlimited_status' => 'required|integer|numeric',
            ];
        }
       
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name_en.required' => 'الاسم بالانجليزي مطلوب',


            'name_ar.required' => 'الاسم بالعربي مطلوب',

            'description_en.required' => 'الوصف بالانجليزي مطلوب',
            'description_en.string' => ' الوصف بالانجليزي يجب ان يكون نص',

            'description_ar.required' => 'الوصف بالعربي مطلوب',
            'description_ar.string' => ' الوصف بالعربي يجب ان يكون نص',

            'price.required' => 'السعر مطلوب',
            'price.numeric' => 'السعر يجب ان يكون ارقام',

            'number_days_ad.required' => 'عدد ايام الاعلان مطلوب',
            'number_days_ad.integer' => ' عدد ايام الاعلان يجب ان يكون ارقام',
            'number_days_ad.numeric' => ' عدد ايام الاعلان يجب ان يكون ارقام',

            'number_days_membership.required' => 'عدد ايام العضوية مطلوب',
            'number_days_membership.integer' => ' عدد ايام العضوية يجب ان يكون ارقام',
            'number_days_membership.numeric' => ' عدد ايام العضوية يجب ان يكون ارقام',

            'number_of_ads.required' => 'عدد الاعلانات مطلوب',
            'number_of_ads.integer' => ' عدد الاعلانات يجب ان يكون ارقام',
            'number_of_ads.numeric' => ' عدد الاعلانات يجب ان يكون ارقام',

            'status.required' => 'الحالة مطلوبة',
            'status.integer' => ' الحالة يجب ان تكون ارقام',
            'status.numeric' => ' الحالة يجب ان تكون ارقام',

            'featured_type.required' => 'نوع التمييز مطلوية',
            'featured_type.integer' => ' نوع التمييز يجب ان تكون ارقام',
            'featured_type.numeric' => ' نوع التمييز يجب ان تكون ارقام',

            'user_type.required' => 'نوع المستخدم مطلوب',
            'user_type.integer' => ' نوع المستخدم يجب ان تكون ارقام',
            'user_type.numeric' => ' نوع المستخدم يجب ان تكون ارقام',

            'unlimited_status.required' => 'اعلانات غير محدودة',
            'unlimited_status.integer' => ' اعلانات غير محدودة يجب ان تكون ارقام',
            'unlimited_status.numeric' => ' اعلانات غير محدودة يجب ان تكون ارقام',
        ];
    }
}
