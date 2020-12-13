<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class examRequest extends FormRequest
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
            'subject'=>'bail| Required',
            'semester'=>'bail| Required',
            'classroom'=>'bail| Required',
            'duration'=>'bail| Required',
            'date'=>'bail| Required',
            'startTime'=>'bail| Required',
        ];
    }
    public function messages()
    {
        return [
            'subject.required' => __('Bạn chưa chọn subject'),
            'semester.required' => __('Bạn chưa chọn semester'),
            'classroom.required' => __('Bạn chưa nhập tên lớp'),
            'duration.required'=> __('Bạn chưa chọn thời gian'),
            'date.required'=> __('Bạn chưa chọn ngày kiểm tra'),
            'startTime.required'=> __('Bạn chưa chọn thời gian bắt đầu'),
        ];
    }
}
