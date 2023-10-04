<?php

namespace App\Http\Requests\Backend\ContactUs;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateContactUsFormRequest extends FormRequest
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
        return [
            'phone' => 'required',
            'phone_two' => 'nullable',
            'email' => 'required|string',
            'url_map' => 'required|url',
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'instagram' => 'required|url',
            'linkedin' => 'required|url',
            'messanger' => 'required|string',
            'background_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }

    public function messages()
    {
        return [

            'phone.required' => 'الهاتف مطلوب',
            'email.required' => 'البريد الالكتروني مطلوب',
            'url_map.required' => 'رابط الخريطه مطلوب',
            'url_map.url' => 'ليس رابط صحيح ',
            'facebook.required' => 'رابط الفيس بوك مطلوب',
            'facebook.url' => 'ليس رابط صحيح ',
            'twitter.required' => 'رابط تويتر مطلوب',
            'twitter.url' => 'ليس رابط صحيح ',
            'instagram.required' => 'رابط انستقرام مطلوب',
            'instagram.url' => 'ليس رابط صحيح ',
            'linkedin.required' => 'رابط لينكد ان مطلوب',
            'linkedin.url' => 'ليس رابط صحيح ',
            'messanger.required' => 'رابط ماسنجر مطلوب  ',
            'background_image.required' => 'صوره الخلفيه مطلوبه',
            'background_image.image' => 'ليس صوره',
            'background_image.mimes' => 'الصوره يجب ان تكون من نوع jpeg,png,jpg,gif,svg',



        ];
    }
}
