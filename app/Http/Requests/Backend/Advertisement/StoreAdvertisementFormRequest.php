<?php

namespace App\Http\Requests\Backend\Advertisement;

use App\Models\FeatureType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAdvertisementFormRequest extends FormRequest
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
        // dd($this->request);
        $form_request = [
            'url_map' => 'required|url',
            'user_id' => 'required',
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
            // 'address' => 'required',
            'price' => 'required',
            'area' => 'required',
            'area_type_id' => 'required',
            'real_estate_formula' => 'required',
            'status' => 'required|integer|numeric',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'video' => 'nullable|mimes:mp4,ogx,oga,ogv,ogg,webm|max:20000',
            'title_ar' => 'required',
            'title_en' => 'required',
            'description_ar' => 'required',
            'description_en' => 'required',
            'user_type' => 'required',
            'expiry_date' => 'required|date_format:Y-m-d|after_or_equal:today',

        ];

        if (request()->user_type == 2) {
            $form_request['contact_method'] = 'required';
        }else{
            $form_request['ad_reference'] = 'required';
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
            'contact_method.required' => 'طريقة  التواصل مطلوبه ',

            'user_id.required' => 'المستخدم مطلوب',
            'target_id.required' => 'الهدف مطلوب',
            'category_id.required' => 'القسم الرئيسي مطلوب',
            'sub_category_id.required' => 'القسم الفرعي مطلوب',
            'construction_age.required' => 'عمر البناء مطلوب',
            'land_area.required' => 'مساحة الارض مطلوبة',
            'real_estate_status.required' => 'حالة العقار مطلوبة',
            'number_of_rooms.required' => 'عدد الغرف مطلوب',
            'number_of_bathrooms.required' => 'عدد الحمامات مطلوب',
            'diyarnaa_country_id.required' => 'الدولة مطلوبة',
            'diyarnaa_city_id.required' => 'المدينة مطلوبة',
            'diyarnaa_region_id.required' => 'المنطقة مطلوبة',
            'address.required' => 'الموقع مطلوب',
            'price.required' => 'السعر مطلوب',
            'area.required' => 'المساحة مطلوبة',
            'area_type_id.required' => ' نوع المساحة مطلوبه ',
            'real_estate_formula.required' => 'الصيغة العقارية مطلوبة',
            'ad_reference.required' => 'رقم الاعلان مطلوب',
            'status.required' => 'الحالة مطلوبة',
            'status.integer' => 'الحالة يجب ان تكون رقم',
            'status.numeric' => 'الحالة يجب ان تكون رقم',
            'main_image.required' => 'الصورة الرئيسية مطلوبة',
            'main_image.image' => 'الصورة الرئيسية يجب ان تكون صورة',
            'main_image.mimes' => 'الصورة الرئيسية يجب ان تكون من نوع jpeg,png,jpg,gif,svg',
            'main_image.max' => 'الصورة الرئيسية يجب ان لا تزيد عن 2048 كيلو بايت',
            'images.required' => 'الصور الاضافية مطلوبة',
            'images.*.image' => 'الصور الاضافية يجب ان تكون صورة',
            'images.*.mimes' => 'الصور الاضافية يجب ان تكون من نوع jpeg,png,jpg,gif,svg',
            'images.*.max' => 'الصور الاضافية يجب ان لا تزيد عن 2048 كيلو بايت',
            'video.mimes' => 'الفيديو يجب ان يكون من نوع mp4,ogx,oga,ogv,ogg,webm',
            'video.max' => 'الفيديو يجب ان لا تزيد عن 20 ميجا',
            'title_ar.required' => 'العنوان بالعربية مطلوب',
            'title_en.required' => 'العنوان بالانجليزية مطلوب',
            'description_ar.required' => 'الوصف  بالعربية مطلوب',
            'description_en.required' => 'الوصف  بالانجليزية مطلوب',
            'code.required' => 'الكود مطلوب',
            'user_type.required' => 'نوع المستخدم مطلوب',
            'expiry_date.required' => ' تاريخ انتهاء الصلاحية مطلوب !!!',
            'expiry_date.date' => ' تاريخ انتهاء الصلاحية يجب ان يكون تاريخ !!!',
            'expiry_date.after_or_equal' => ' تاريخ انتهاء الصلاحية يجب ان يكون اكبر من او يساوي تاريخ اليوم !!!',

        ];
    }
}
