<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentExamRepository
{
    public function getExamByStudentID($studentID)
    {
       return DB::table('student_exams')
        ->where('student_id', $studentID)
        ->join('exams','exams.id','=','student_exams.exam_id')
        ->first();
    }

    public function createStudentExam($studentID, $examID, $question_set_id)
    {
        $data = [
            'student_id' => $studentID,
            'exam_id' => $examID,
            'question_set_id' => $question_set_id,
            'created_by' => Auth::user()->id,
            'updated_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        DB::table('student_exams')
            ->insert($data);
    }
}
