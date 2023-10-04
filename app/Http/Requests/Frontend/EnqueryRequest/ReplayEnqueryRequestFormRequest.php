<?php

namespace App\Http\Requests\Frontend\EnqueryRequest;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReplayEnqueryRequestFormRequest extends FormRequest
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
            'replay' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'replay.required' =>@trans('validation.ReplyIsRequired'),
        ];
    }
}
