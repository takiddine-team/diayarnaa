<?php

namespace App\Http\Requests\Frontend\Search;

use App\Models\FeatureType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreSearchFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('user')->check();
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
            'title.required' => @trans('validation.TitleRequired'),
            'category_id.required' => @trans('validation.CategoryId'),
            'sub_category_id.required' => @trans('validation.SubCategoryId'),
            'construction_age.required' => @trans('validation.construction_age'),
            'land_area.required' => @trans('validation.land_area'),
            'real_estate_status.required' => @trans('validation.real_estate_status'),
            'number_of_rooms.required' => @trans('validation.number_of_rooms'),
            'number_of_bathrooms.required' => @trans('validation.number_of_bathrooms'),
            'diyarnaa_country_id.required' => @trans('validation.diyarnaa_city_id'),
            'diyarnaa_city_id.required' => @trans('validation.diyarnaa_city_id'),
            'diyarnaa_region_id.required' => @trans('validation.diyarnaa_region_id'),
            'price_from.required' => @trans('validation.price_from'),
            'price_from.lt' => @trans('validation.price_from_lt'),
            'price_to.required' => @trans('validation.price_to'),
            'price_to.gt' => @trans('validation.price_to_gt'),

            'area_from.required' => @trans('validation.area_from'),
            'area_from.lt' => @trans('validation.area_from_lt'),

            'area_to.required' => @trans('validation.area_to'),
            'area_to.gt' => @trans('validation.area_to_gt'),
            'area_type_id.required' => @trans('validation.area_type_id'),
            'main_image.required' => @trans('validation.main_image'),

        ];
    }
}
