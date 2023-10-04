<?php

namespace App\Http\Requests\Backend\Faq;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateFaqFormRequest extends FormRequest
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
            'faq_question_ar' => 'required|unique:faqs,faq_question_ar,'.$this->id,
            'faq_question_en' => 'required|unique:faqs,faq_question_en,'.$this->id,
            'faq_answer_ar' => 'required',
            'faq_answer_en' => 'required',
            'status' => 'required|numeric|integer',

            //
        ];
    }

    public function messages()
    {
        return [
            'faq_question_ar.required' => 'Question AR is required !!!',
            'faq_question_ar.unique' => 'Question AR is already exist !!!',

            'faq_question_en.required' => 'Question EN is required !!!',
            'faq_question_en.unique' => 'Question EN is already exist !!!',

            'faq_answer_ar.required' => 'Answer AR is required !!!',

            'faq_answer_en.required' => 'Answer EN is required !!!',

            'status.required' => 'الحالة مطلوبة !!!',
            'status.numeric' => 'Status must be number !!!',
            'status.integer' => 'Status must be integer !!!',

            //
        ];
    }
}
