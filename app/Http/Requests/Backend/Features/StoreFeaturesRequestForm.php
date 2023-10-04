<?php

namespace App\Http\Requests\Backend\Features;

use App\Models\Feature;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreFeaturesRequestForm extends FormRequest
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


        $feature = Feature::where('name_en' , $this->name_en)->where('name_ar' , $this->name_ar)->where('feature_type_id' , $this->feature_type_id)->first();
        if ($feature) {
            return [
                'name_en' => 'required|unique:features,name_en' ,
                'name_ar' => 'required|unique:features,name_ar',
                'feature_type_id' => 'required',
                'status' => 'required',
            ];
        } else {
            return [
                'name_en' => 'required',
                'name_ar' => 'required',
                'feature_type_id' => 'required',
                'status' => 'required',
            ];
        }
       
    }

    public function messages()
    {
        return [
            'name_en.required' => 'الاسم بالانجليزي مطلوب',
            'name_en.unique' => 'الاسم بالانجليزي مسجل من قبل',

            'name_ar.required' => 'الاسم بالعربي مطلوب',
            'name_ar.unique' => 'الاسم بالعربي مسجل من قبل',

          
            'status.required' => 'الحالة مطلوبة',
            'status.integer' => ' الحالة يجب ان تكون رقم',
            'status.numeric' => ' الحالة يجب ان تكون رقم',

            'feature_type_id.required' => 'نوع الميزة مطلوب',

        ];
    }
}
