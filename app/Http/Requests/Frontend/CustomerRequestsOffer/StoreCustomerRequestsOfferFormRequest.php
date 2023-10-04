<?php

namespace App\Http\Requests\Frontend\CustomerRequestsOffer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCustomerRequestsOfferFormRequest extends FormRequest
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
        return [
            'name' => 'required',
            'advertising' => 'required',
            'phone' => 'required|min:10',
            'target_id' => 'required|integer',
            'category_id' => 'required|integer',
            'sub_category_id' => 'required|integer',
            'diyarnaa_country_id' => 'required|integer',
            'diyarnaa_city_id' => 'required|integer',
            'diyarnaa_region_id' => 'required|integer',
            'price' => 'required|integer',
            'area' => 'required',
            'address' => 'required',
            'type' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'mimes:mp4,mov,ogg,qt,webm|max:20000',

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


            'advertising.required' => @trans('validation.AdIsRequired'),
            'name.required' =>  @trans('validation.name'),
            'phone.required' => @trans('validation.phone'),
            'target_id.required' => @trans('validate.TargetId'),
            'category_id.required' => @trans('validate.CategoryId'),
            'sub_category_id.required' => @trans('validate.SubCategoryId'),
            'diyarnaa_country_id.required' => @trans('validate.diyarnaa_country_id'),
            'diyarnaa_city_id.required' => @trans('validate.diyarnaa_city_id'),
            'diyarnaa_region_id.required' => @trans('validate.SelectRegion'),
            'price.required' => @trans('validate.Price'),
            'area.required' => @trans('validate.Area'),
            'address.required' => @trans('validate.Address'),
            'type.required' => @trans('Type'),
            'images.*.image' => @trans('validate.Images'),
            'images.*.mimes' => @trans('validate.ImagesMimes'),
            'images.*.max' => @trans('validate.ImagesMax'),
            'video.mimes' => @trans('validate.VideoMimes'),
            'video.max' => @trans('validate.VideoMax'),
            // 'video.max' => 'الفيديو يجب ان لا تزيد عن 20 ميجا',
            // 'video.max' => 'الفيديو يجب ان لا يزيد عن 20 ميجا',
        ];
    }
}
