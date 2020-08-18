<?php

namespace App\Repositories;

use App\Question;
use Illuminate\Support\Facades\DB;

class QuestionRepository extends BaseRepository {
  public function model()
    {
        return Question::class;
    }

    public function query()
    {
        $query = $this->model->select(
            'id',
            'question',
            'type',
            'subject'
        );
        return $query;
    }

    public function getAllQuestion()
    {
        $listExam = DB::table('questions')->get();
        return $listExam;
    }

    public function getRecentlyAddedQuestion(){

        $listExam = DB::table('questions')->limit(3)->get();
        return $listExam;

    }

    public function getQuestionDetail($id)
    {
        $query = $this->query()->addSelect('created_at', 'created_by', 'updated_at', 'updated_by');

        return $query->findOrFail($id);
    }
    public function storageQuestion($id, $question, $type, $subject){
        DB::table('questions')->insert([
            ['id' => $id],
            ['question' => $question],
            ['type' => $type],
            ['subject' => $subject]
        ]);
    }
}
