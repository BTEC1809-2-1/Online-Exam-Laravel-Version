<?php

namespace App\Repositories;

use App\Answer;
use Illuminate\Support\Facades\DB;

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

    /**
     * Take $question_id parameter
     * Search for every answer in DB match with the parameter
     * Receive all matched questions
     */
    public function getAnswers($question_id){
        $answers = Answer::all()
                    ->where('question_id', '=' , $question_id);
        return $answers;
    }

    public function delete($question_id)
    {
        Answer::where('question_id', '=', $question_id)->delete();
    }
}
