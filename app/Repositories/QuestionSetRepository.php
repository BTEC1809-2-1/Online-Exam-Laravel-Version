<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class QuestionSetRepository 
{
    public function getQuestionSetByExam($examID)
    {
        return DB::table('question_set')
        ->select('questions')
        ->where('id', $examID)
        ->get();
    }
}