<?php

namespace App\Http\Requests\Backend\HomeSlider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreHomeSliderFormRequest extends FormRequest
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
            'company_name_ar' => 'required',
            'company_name_en' => 'required',
            'diyarnaa_country_id' => 'required',
            'diyarnaa_city_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'license_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'expire_date' => 'required|date_format:Y-m-d|after_or_equal:today',
            'user_type' => 'required|integer|numeric',
        
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'company_name_ar.required' => 'اسم الشركة بالعربي مطلوب',
            'company_name_en.required' => 'اسم الشركة بالانجليزي مطلوب',
            'diyarnaa_country_id.required' => 'الدولة مطلوبة',
            'diyarnaa_city_id.required' => 'المدينة مطلوبة',
            'image.required' => 'الصورة مطلوبة',
            'image.image' => 'الصورة يجب ان تكون صورة',
            'image.mimes' => 'الصورة يجب ان تكون من نوع jpeg,png,jpg,gif,svg',
            'image.max' => 'الصورة يجب ان لا تزيد عن 2048 كيلو بايت',
            'license_image.required' => 'صورة الرخصة مطلوبة',
            'license_image.image' => 'صورة الرخصة يجب ان تكون صورة',
            'license_image.mimes' => 'صورة الرخصة يجب ان تكون من نوع jpeg,png,jpg,gif,svg',
            'license_image.max' => 'صورة الرخصة يجب ان لا تزيد عن 2048 كيلو بايت',
            'title_ar.required' => 'العنوان بالعربي مطلوب',
            'title_en.required' => 'العنوان بالانجليزي مطلوب',
            'description_ar.required' => 'الوصف بالعربي مطلوب',
            'description_en.required' => 'الوصف بالانجليزي مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'email.email' => 'البريد الالكتروني يجب ان يكون بريد الكتروني',
           
            'expire_date.required' => 'تاريخ الانتهاء مطلوب',
            'expire_date.date' => 'تاريخ الانتهاء يجب ان يكون تاريخ',
            'expire_date.after_or_equal' => 'تاريخ الانتهاء يجب ان يكون تاريخ بعد او يساوي تاريخ اليوم',

            'user_type.required' => 'نوع المستخدم مطلوب',
            'user_type.integer' => 'نوع المستخدم يجب ان يكون رقم',
            'user_type.numeric' => 'نوع المستخدم يجب ان يكون رقم',
            
        
        ];
    }
}
