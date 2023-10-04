<?php

namespace App\Http\Requests\Frontend\Advertisement;

use App\Models\FeatureType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class updateAdvertisementFormRequest extends FormRequest
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

        if (isset(Auth::guard('user')->user()->user_type) && Auth::guard('user')->user()->user_type == 'Real Estate Office') {
            $form_request = [
                'target_id' => 'required',
                'category_id' => 'required',
                'sub_category_id' => 'required',
                'construction_age' => 'nullable',
                'land_area' => 'nullable',
                'real_estate_status' => 'nullable',
                'number_of_rooms' => 'nullable',
                'number_of_bathrooms' => 'nullable',
                'diyarnaa_city_id' => 'required',
                'diyarnaa_region_id' => 'required',
                'url_map' => 'required|url',
                'price' => 'required',
                'area' => 'required',
                'area_type_id' => 'required',
                'real_estate_formula' => 'required|min:100',
                'ad_reference' => 'required',
                'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'video' => 'nullable|mimes:mp4,ogx,oga,ogv,ogg,webm|max:20000',
                'title_ar' => 'required',
                'title_en' => 'required',
                // 'description_ar' => 'required',
                // 'description_en' => 'required',
            ];
        } else if (isset(Auth::guard('user')->user()->user_type) && Auth::guard('user')->user()->user_type == 'Real Estate Owner') {

            $form_request = [
                'target_id' => 'required',
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
                'url_map' => 'required|url',
                'price' => 'required',
                'area' => 'required',
                'area_type_id' => 'required',
                'real_estate_formula' => 'required|min:100',
                'main_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'video' => 'nullable|mimes:mp4,ogx,oga,ogv,ogg,webm|max:20000',
                'title_ar' => 'required',
                'title_en' => 'required',
                // 'description_ar' => 'required',
                // 'description_en' => 'required',
                'contact_method' => 'required',
            ];
        }

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
            'contact_method.required' => @trans('validation.contact_method'),
            'target_id.required' => @trans('validation.target_id'),
            'category_id.required' => @trans('validation.CategoryId'),
            'sub_category_id.required' => @trans('validation.SubCategoryId'),
            'construction_age.required' => @trans('validation.construction_age'),
            'land_area.required' => @trans('validation.land_area'),
            'real_estate_status.required' => @trans('validation.real_estate_status'),
            'number_of_rooms.required' => @trans('validation.number_of_rooms'),
            'number_of_bathrooms.required' => @trans('validation.number_of_bathrooms'),
            'diyarnaa_country_id.required' => @trans('validation.diyarnaa_country_id'),
            'diyarnaa_city_id.required' => @trans('validation.diyarnaa_city_id'),
            'diyarnaa_region_id.required' => @trans('validation.diyarnaa_region_id'),
            'url_map.required' => @trans('validation.url_map'),
            'url_map.url' =>  @trans('validation.url_map_url'),
            'address.required' => @trans('validation.Address'),
            'price.required' => @trans('validation.Price'),
            'area.required' => @trans('validation.Area'),


            'real_estate_formula.required' => @trans('validation.real_estate_formula'),
            'real_estate_formula.min' => @trans('validation.real_estate_formula_min'),
            'area_type_id.required' => @trans('validation.area_type_id'),

            'ad_reference.required' => @trans('validation.ad_reference'),
            'status.required' => @trans('validation.status'),
            'status.integer' => @trans('validation.statusInteger'),
            'status.numeric' => @trans('validation.statusNumeric'),
            'main_image.required' => @trans('validation.main_image'),
            'main_image.image' => @trans('validation.Images'),
            'main_image.mimes' => @trans('validation.ImagesMimes'),
            'main_image.max' => @trans('validation.ImagesMax'),
            'images.required' => @trans('validation.otherImages'),
            'images.*.image' => @trans('validation.otherImagesType'),
            'images.*.mimes' =>  @trans('validation.otherImagesTypeMimes'),
            'images.*.max' => @trans('validation.otherImagesMax'),
            'video.mimes' => @trans('validation.VideoMimes'),
            'video.max' => @trans('validation.VideoMax'),
            'title_ar.required' => @trans('validation.TitleAR'),
            'title_en.required' => @trans('validation.TitleEN'),
            'description_ar.required' => @trans('validation.DescriptionArRequired'),
            'description_en.required' => @trans('validation.DescriptionEnRequired'),
            'code.required' => @trans('validation.codeRequired'),
            // 'code.unique' =>@trans('validation.codeUnique'),
        ];
    }
}
