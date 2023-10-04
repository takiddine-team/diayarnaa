<?php

namespace App\Http\Requests\Backend\PremiumMembershipPage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePremiumMembershipPageFormRequest extends FormRequest
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
            'description_ar' => 'required|string',
            'description_en' => 'required|string',
            'image' => 'mimes:g3,gif,ief,jpeg,jpg,jpe,ktx,png,btif,sgi,svg,svgz,tiff,tif,webp|max:4048',
        
        ];
    }

    public function messages()
    {
        return [
            'description_ar.required' => 'وصف الصفحة بالعربي مطلوب',
            'description_en.required' => 'وصف الصفحة بالانجليزي مطلوب',
            'image.mimes' => 'صورة الصفحة يجب ان تكون صورة',
            'image.max' => 'صورة الصفحة يجب ان تكون اقل من 4 ميجا',
        ];
    }
}
