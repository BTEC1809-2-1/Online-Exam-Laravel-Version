<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionSetRepository
{
    public function getQuestionSetByExam($examID)
    {
        $questionSet = DB::table('question_set')->where('id', 'like', $examID."%");
        if($questionSet->exists())
        {
            return $questionSet->get()->toArray();
        }
        return null;
    }

    public function getQuestionsBySetId($id)
    {
        if(DB::table('question_set')
            ->where('id', $id)
            ->exists()
        )
        return
            DB::table('question_set')
                ->select('questions')
                ->where('id', $id)
                ->get();
    }

    public function getExamQuestionSets($examID)
    {
        return DB::table('question_set')->where('id', 'like', $examID.'%')->get();
    }

    public function createQuestionSet($setID, $question_set, $subject)
    {
        $data = [
            'id' => $setID,
            'questions' => $question_set,
            'subject' => $subject,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('question_set')->insert($data);
    }

    public function deleteQuestionSetsByExamID($examID)
    {
        DB::table('question_set')->where('id', 'like', $examID.'%')->delete();
    }
}
