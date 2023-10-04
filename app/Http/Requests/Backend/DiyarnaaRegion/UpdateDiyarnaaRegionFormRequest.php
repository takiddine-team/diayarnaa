<?php

namespace App\Http\Requests\Backend\DiyarnaaRegion;

use App\Models\DiyarnaaRegion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiyarnaaRegionFormRequest extends FormRequest
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
        $diyarnaa_region = DiyarnaaRegion::where('name_en', $this->name_en)->orWhere('name_ar',  $this->name_ar)->where('diyarnaa_city_id', $this->diyarnaa_city_id)->where('id', '!=', $this->id)->first();
        if (!$diyarnaa_region) {
            return [
                'name_ar' => 'required',
                'name_en' => 'required',
                "diyarnaa_city_id" => 'required',
            ];
        } else {
            return [
                'name_ar' => 'required|unique:diyarnaa_regions,name_ar,' . $this->id,
                'name_en' => 'required|unique:diyarnaa_regions,name_en,' . $this->id,
                "diyarnaa_city_id" => 'required',
            ];
        }
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
            'diyarnaa_city_id.required' => 'المدينة مطلوبة',
        ];
    }
}
