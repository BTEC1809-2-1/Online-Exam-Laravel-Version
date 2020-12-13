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


    //OPTIMIZE: optimize these two functions, they can be merged
    public function saveMultipleQuestionAnswers($request, $questionID, $date)
    {
        $answers = [];
        foreach($request->answer as $index=>$answer)
        {
            $answers[] = [
                'index' => $index,
                'content' => $answer
            ];
        }

        $_is_correct = [
            $request->is_correct1 ?? "",
            $request->is_correct2 ?? "",
            $request->is_correct3 ?? "",
            $request->is_correct4 ?? "",
        ];

        $data = [

            'id' => 'A'.$questionID.$date,
            'question_id' => $questionID,
            'answer' => json_encode($answers),
            'is_correct' => json_encode($_is_correct),
            'created_by' => Auth::user()->name,
            'created_at' => now(),
            'updated_by' => Auth::user()->name,
            'updated_at' => now(),
        ];
        Answer::insert($data);
    }

    public function saveSingleChoiceOrTrueFalseQuestionAnswers($request, $questionID, $date)
    {
        $answers = [];
        foreach($request->answer as $index=>$answer)
        {
            $answers[] = [
                'index' => $index,
                'content' => $answer
            ];
        }
        $data = [
            'id' => 'A'.$questionID.$date,
            'question_id' => $questionID,
            'answer' => json_encode($answers),
            'is_correct' => $request->is_correct,
            'created_by' => Auth::user()->name,
            'created_at' => now(),
            'updated_by' => Auth::user()->name,
            'updated_at' => now(),
        ];
        Answer::insert($data);
    }

    public function getAnswers($questionID)
    {
        return  Answer::where('question_id', $questionID)->first();
    }

    public function deleteAllAnswerByQuestionID($questionID)
    {
        Answer::where('question_id', $questionID)->delete();
    }

    public function updateDetail($request, $questionID)
    {
        foreach($request->answer as $index=>$answer)
        {
            $answers[] = [
                'index' => $index,
                'content' => $answer
            ];
        }
        if(is_array($request->is_correct))
        {
            $is_correct =  json_encode($request->is_correct);
        }else {
            $is_correct =  $request->is_correct;
        }

        Answer::where('question_id', $questionID)->update([
            'answer' => json_encode($answers),
            'is_correct' => $is_correct
        ]);
    }
}
