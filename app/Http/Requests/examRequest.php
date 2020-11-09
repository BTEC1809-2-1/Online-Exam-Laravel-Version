<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'semester'=> 'bail|required',
            'subject'=> 'bail|required',
            'class'=> 'bail|required',
            'lecture'=> 'bail|required',
            'duration'=> 'bail|required',
            'date'=> 'bail|required',
            'startTime'=> 'bail|required',
            'number_of_set'=> 'bail|required',
            'question_per_set'=> 'bail|required',
            'point_ratio'=> 'bail|required',
        ];
    }
}
