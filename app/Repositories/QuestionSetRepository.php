<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionSetRepository
{
    public function getQuestionSetByExam($examID)
    {
        if(DB::table('question_set')
            ->where('id', 'like', $examID."%")
            ->exists()
        )
        return
            DB::table('question_set')
                ->where('id', 'like', $examID."%")
                ->get();
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


    public function createQuestionSet($setID, $question_set, $studentID, $subject)
    {
        $data = [
            'id' => $setID,
            'questions' => $question_set,
            'student_id' => $studentID,
            'subject' => $subject,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('question_set')
            ->insert($data);
    }
}