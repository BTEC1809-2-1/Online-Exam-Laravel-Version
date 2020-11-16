<?php
namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamQuestionRepository
{
    public function deleteExamQuestionByExamID($examID)
    {
        DB::table('exam_questions')
        ->where('exam_id', $examID)
        ->delete();
    }
}
