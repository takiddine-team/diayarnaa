<?php

namespace App\Http\Requests\Backend\DiyarnaaRegion;

use App\Models\DiyarnaaRegion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreDiyarnaaRegionFormRequest extends FormRequest
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
                'name_ar' => 'required',
                'name_en' => 'required',
                'name_ar.*' => 'required',
                'name_en.*' => 'required',
                "diyarnaa_city_id" => 'required',
            ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */

    public function messages()
    {
        return [
            'name_ar.required' => 'الاسم بالعربي مطلوب',
            'name_en.required' => 'الاسم بالانجليزي مطلوب',
            'name_ar.*.required' => 'الاسم بالعربي مطلوب',
            'name_en.*.required' => 'الاسم بالانجليزي مطلوب',
            'diyarnaa_city_id.required' => 'المدينة مطلوبة',
        ];
    }
}
