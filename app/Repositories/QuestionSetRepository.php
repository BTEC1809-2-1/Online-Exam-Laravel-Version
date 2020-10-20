<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class QuestionSetRepository 
{
    public function getQuestionSetByExam($examID, $student_id)
    {
        return DB::table('question_set')
        ->select('questions')
        ->where('id', $examID."%")
        ->where('student_id', $student_id)
        ->get();
    }
}