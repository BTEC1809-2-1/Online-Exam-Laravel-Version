<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class questionRequest extends FormRequest
{
/**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'question'=>'Required|max:255',
            'questionType'=>'Required',
            'subject'=>'Required',
        ];
    }
    public function messages()
{
    return [
        'question.required' => __('Bạn chưa nhập câu hỏi.'),
        'subject.required' => __('Bạn chưa chọn subject'),
        'questionType.required'=> __('Bạn chưa chọn questtion type.'),
    ];
}
}
