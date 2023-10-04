<?php

namespace App\Http\Requests\Backend\Search;

use App\Models\FeatureType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateSearchFormRequest extends FormRequest
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

        $form_request = [
            'title' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'construction_age' => 'nullable',
            'land_area' => 'nullable',
            'real_estate_status' => 'nullable',
            'number_of_rooms' => 'nullable',
            'number_of_bathrooms' => 'nullable',
            'diyarnaa_country_id' => 'required',
            'diyarnaa_city_id' => 'required',
            'status' => 'required',
            'diyarnaa_region_id' => 'required',
            'price_from' => 'required|lt:price_to',
            'price_to' => 'required|gt:price_from',
            'area_from' => 'required|lt:area_to',
            'area_to' => 'required|gt:area_from',
            'area_type_id' => 'required',
        ];
        $feature_type_array = FeatureType::WhereHas('subCategories', function ($query) {
            $query->where('sub_category_id', $this->sub_category_id);
        })->pluck('id')->toArray();
        if (in_array(1, $feature_type_array)) {
            $form_request['construction_age'] = 'required';
        }
        if (in_array(2, $feature_type_array)) {
            $form_request['land_area'] = 'required';
        }
        if (in_array(3, $feature_type_array)) {
            $form_request['real_estate_status'] = 'required';
        }
        if (in_array(4, $feature_type_array)) {
            $form_request['number_of_rooms'] = 'required';
        }
        if (in_array(5, $feature_type_array)) {
            $form_request['number_of_bathrooms'] = 'required';
        }

        return $form_request;
    }

    public function messages()
    {
        return [
            'title.required' => ' العنوان مطلوب',
            'category_id.required' => 'القسم الرئيسي مطلوب',
            'sub_category_id.required' => 'القسم الفرعي مطلوب',
            'construction_age.required' => 'عمر البناء مطلوب',
            'land_area.required' => 'مساحة الارض مطلوبة',
            'real_estate_status.required' => 'حالة العقار مطلوبة',
            'status.required' => 'الحالة  مطلوبة',

            'number_of_rooms.required' => 'عدد الغرف مطلوب',
            'number_of_bathrooms.required' => 'عدد الحمامات مطلوب',
            'diyarnaa_country_id.required' => 'الدولة مطلوبة',
            'diyarnaa_city_id.required' => 'المدينة مطلوبة',
            'diyarnaa_region_id.required' => 'المنطقة مطلوبة',
            'price_from.required' => 'السعر من مطلوب',
            'price_from.lt' => '  السعر من يجب ان يكون اصغر من السعر الى' ,
            'price_to.required' => 'السعر الى مطلوب',
            'price_to.gt' => 'السعر الى يجب ان يكون اكبر من السعر من',

            'area_from.required' => 'المساحة من مطلوبة',
            'area_from.lt' => 'المساحة من يجب ان تكون اصغر من المساحة الى',
            'area_type_id.required' => ' نوع المساحة مطلوبه ',
            'area_to.required' => 'المساحة الى مطلوبة',
            'area_to.gt' => 'المساحة الى يجب ان تكون اكبر من المساحة من',

        ];
    }
}
