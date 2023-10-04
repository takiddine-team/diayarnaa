<?php

namespace App\Http\Requests\Backend\Abouts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAboutFormRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        //mimes:g3,gif,ief,jpeg,jpg,jpe,ktx,png,btif,sgi,svg,svgz,tiff,tif,webp|max:4048
        return [
            'about_description_en' => 'required',
            'about_description_ar' => 'required',
            'about_image' => 'mimes:g3,gif,ief,jpeg,jpg,jpe,ktx,png,btif,sgi,svg,svgz,tiff,tif,webp|max:4048',

            'our_message_en' => 'required',
            'our_message_ar' => 'required',
            'our_message_image' => 'mimes:g3,gif,ief,jpeg,jpg,jpe,ktx,png,btif,sgi,svg,svgz,tiff,tif,webp|max:4048',

            'our_vission_en' => 'required',
            'our_vission_ar' => 'required',
            'our_vission_image' => 'mimes:g3,gif,ief,jpeg,jpg,jpe,ktx,png,btif,sgi,svg,svgz,tiff,tif,webp|max:4048',

            'our_value_en' => 'required',
            'our_value_ar' => 'required',
            'our_value_image' => 'mimes:g3,gif,ief,jpeg,jpg,jpe,ktx,png,btif,sgi,svg,svgz,tiff,tif,webp|max:4048',

            'background_company_image'=>'mimes:g3,gif,ief,jpeg,jpg,jpe,ktx,png,btif,sgi,svg,svgz,tiff,tif,webp|max:4048',
            'background_aboutus_image'=>'mimes:g3,gif,ief,jpeg,jpg,jpe,ktx,png,btif,sgi,svg,svgz,tiff,tif,webp|max:4048',
        ];
    }

    public function messages()
    {
        return [
            'about_description_en.required' => 'وصف من نحن بالانجليزي مطلوب',
            'about_description_ar.required' => 'وصف من نحن بالعربي مطلوب',
            'about_image.mimes' => 'صورة من نحن مطلوبة',
            'about_image.max' => 'صورة من يجب ان تكون اقل من 4 ميجا',

            'our_message_en.required' => 'رساالتنا بالانجليزي مطلوب',
            'our_message_ar.required' => 'رساالتنا بالعربي مطلوب',
            'our_message_image.mimes' => 'صورة رساالتنا يجب ان تكون صورة',
            'our_message_image.max' => 'صورة رساالتنا يجب ان تكون اقل من 4 ميجا',

            'our_vission_en.required' => 'رؤيتنا بالانجليزي مطلوب',
            'our_vission_ar.required' => 'رؤيتنا بالعربي مطلوب',
            'our_vission_image.mimes' => 'رؤيتنا صورة يجب ان تكون صورة',
            'our_vission_image.max' => 'رؤيتنا صورة يجب ان تكون اقل من 4 ميجا',

            'our_value_en.required' => 'قيمنا بالانجليزي مطلوب',
            'our_value_ar.required' => 'قيمنا بالعربي مطلوب',
            'our_value_image.mimes' => 'قيمنا صورة يجب ان تكون صورة',
            'our_value_image.max' => 'قيمنا صورة يجب ان تكون اقل من 4 ميجا',

            'background_company_image.mimes' => 'صورة الخلفية للشركة يجب ان تكون صورة',
            'background_company_image.max' => 'صورة الخلفية للشركة يجب ان تكون اقل من 4 ميجا',
            
            'background_aboutus_image.mimes' => 'صورة الخلفية لمن نحن يجب ان تكون صورة',
            'background_aboutus_image.max' => 'صورة الخلفية لمن نحن يجب ان تكون اقل من 4 ميجا',


        ];
    }
}
