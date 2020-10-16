<?php

namespace App\Repositories;

use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\elementType;

class AnswerRepository extends BaseRepository {
    public function model()
    {
        return Answer::class;
    }


    public function query()
    {
        $query = $this->model->select(
            'id',
            'question_id',
            'answer',
            'is_correct'
        );
        return $query;
    }

    public function saveMultipleQuestionAnswers(Request $request, $questionID, $date)
    {
        $data = [];
        foreach($request->answer as $index=>$answer){
            foreach($request->is_correct as $icIndex=>$ic)
            {
                if($icIndex==$index && $request->is_correct[$index]==1)
                {
                    $_is_correct = 1;
                }
                else{
                    $_is_correct = 0;
                }
            };
            $data += [
                $index => [
                    'id' => 'A'.$questionID.$date.$index,
                    'question_id' => $questionID,
                    'answer' => $request->answer[$index],
                    'is_correct' => $_is_correct,
                    'created_by' => Auth::user()->name,
                    'created_at' => now(),
                    'updated_by' => Auth::user()->name,
                    'updated_at' => now(),
                ]
            ];
        }
        Answer::insert($data);
    }

    public function saveSingleChoiceOrTrueFalseQuestionAnswers(Request $request, $questionID, $date)
    {
        $data = [];
        foreach($request->answer as $index=>$answer)
        {
            $data += [
                $index => [
                    'id' => 'A'.$questionID.$date.$index,
                    'question_id' => $questionID,
                    'answer' => $request->answer[$index],
                    'created_by' => Auth::user()->name,
                    'created_at' => now(),
                    'updated_by' => Auth::user()->name,
                    'updated_at' => now(),
                ]
            ];
            if($index == $request->is_correct)
            {
                $data[$index]['is_correct'] = 1;
            }else
            {
                $data[$index]['is_correct'] = 0;
            }
        }
        Answer::insert($data);
    }

    public function getAnswers($questionID)
    {
        return  Answer::where('question_id', $questionID)->get();
    }

    public function deleteAllAnswerByQuestionID($question_id)
    {
        Answer::where('question_id', '=', $question_id)->delete();
    }
}
