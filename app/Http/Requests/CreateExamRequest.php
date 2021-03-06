<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateExamRequest extends FormRequest
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
            'semester'         => 'required',
            'subject'          => 'required',
            'classroom'        => 'required',
            'lecture'          => 'required',
            'duration'         => 'required|date_format:H:i:s',
            'date'             => 'required|date',
            'time'             => 'required|date_format:H:i',
            'exam_type'        => 'required|numeric',
            'number_of_set'    => 'required',
            'question_per_set' => 'required',
            'extra_student'    => ''
        ];
    }
}
