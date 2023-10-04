<?php

namespace App\Http\Requests\Backend\DiyarnaaCity;

use App\Models\DiyarnaaCity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiyarnaaCityFormRequest extends FormRequest
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

        $diyarnaa_city = DiyarnaaCity::where('name_en', $this->name_en)->orWhere('name_ar',  $this->name_ar)->where('diyarnaa_country_id', $this->diyarnaa_country_id)->where('id', '!=', $this->id)->first();
        // $diyarnaa_city2 = DiyarnaaCity::where('name_en', $this->name_ar)->orWhere('name_ar', $this->name_en)->Where('diyarnaa_country_id', $this->diyarnaa_country_id)->where('id', '!=', $this->id)->first();
        if ($diyarnaa_city) {
            return [
                'name_en' => 'required|unique:diyarnaa_cities,name_en,' . $this->id,
                'name_ar' => 'required|unique:diyarnaa_cities,name_ar,' . $this->id,
                'diyarnaa_country_id' => 'required',
            ];
        } else {
            return [
                'name_en' => 'required',
                'name_ar' => 'required',
                'diyarnaa_country_id' => 'required',
            ];
        }
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'name_ar.required' => 'الاسم بالعربي مطلوب',
            'name_en.required' => 'الاسم بالانجليزي مطلوب',
            'diyarnaa_country_id.required' => 'الدولة مطلوبة',

            'name_ar.unique' => 'الاسم بالعربي  مسجل من قبل',
            'name_en.unique' => 'الاسم بالانجليزي مسجل من قبل',

        ];
    }
}
