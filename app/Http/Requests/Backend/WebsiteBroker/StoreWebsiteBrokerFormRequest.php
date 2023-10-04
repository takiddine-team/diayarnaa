<?php

namespace App\Http\Requests\Backend\WebsiteBroker;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreWebsiteBrokerFormRequest extends FormRequest
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
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:website_brokers,email',
            'phone' => 'required|unique:website_brokers,phone',

            'diyarnaa_country_id' => 'required',
            'diyarnaa_city_id' => 'required|exists:diyarnaa_cities,id',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file' => 'nullable|file|mimes:pdf,doc,docx,zip',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب',
            'last_name.required' => 'الاسم الاخير مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'diyarnaa_country_id.required' => 'الدولة مطلوبة',
            'diyarnaa_city_id.required' => 'المدينة مطلوبة',
            'diyarnaa_city_id.exists' => 'المدينة غير موجودة',
            'status.required' => 'الحالة مطلوبة',
            'image.required' => 'الصورة مطلوبة',
            'image.image' => 'الصورة يجب ان تكون صورة',
            'image.mimes' => 'الصورة يجب ان تكون من نوع jpeg,png,jpg,gif,svg',
            'image.max' => 'الصورة يجب ان لا تزيد عن 2048 كيلوبايت',
            'file.file' => 'الملف يجب ان يكون ملف',
            'file.mimes' => 'الملف يجب ان يكون من نوع pdf,doc,docx,zip',
            'file.required' => 'الملف مطلوب',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.unique' => 'رقم الهاتف موجود مسبقا',

        ];
    }
}
