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

    public function getAllAnswer()
    {
        $listAnswer = DB::table('Answers')->get();
        return $listAnswer;
    }

    public function getRecentlyAddedAnswer(){

        $listAnswer = DB::table('Answers')->limit(3)->get();
        return $listAnswer;

    }

    public function getAnswerDetail($id)
    {
        $query = $this->query()->addSelect('created_at', 'created_by', 'updated_at', 'updated_by');

        return $query->findOrFail($id);
    }

    public function addAnswers($answer){
        DB::table('answers')->insert([
            $answer
            // ['id' => $id],
            // ['question_id' => $question_id],
            // ['answer' => $answer],
            // ['is_correct' => $is_correct],
            // ['created_at' => $created_at],
            // ['created_by' => $created_by],
            // ['updated_at' => $updated_at],
            // ['updated_by' => $updated_by]
        ]);
    }
}
