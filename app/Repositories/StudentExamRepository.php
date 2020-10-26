<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentExamRepository
{
    protected $table;

    public function __construct()
    {
        $this->table = DB::table('student_exams');
    }

    public function getExamByStudentID($studentID)
    {
       if
        (
           DB::table('student_exams')
                ->where('student_id', $studentID)
                ->exists()
        )
        {
            return DB::table('student_exams')
                        ->join('exams','exams.id','=','student_exams.exam_id')
                        ->select('exams.id', 'exams.start_at', 'exams.subject', 'exams.duration')
                        ->where('student_id', $studentID)
                        ->first();
        }
       return null;
    }

    public function addStudentToExam($studentID, $examID, $question_set_id)
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

    public function getStudentQuestionSet($examID, $studentID)
    {
        if($this->table
                ->where('exam_id', $examID)
                ->where('student_id', $studentID)
                ->exists())
        {
            return $this->table
                        ->select('question_set_id')
                        ->where('exam_id', $examID)
                        ->where('student_id', $studentID)
                        ->first();
        }
    }
    
    public function updateStudentAnswer($studentID, $examID, $answers)
    {
        if($this->table
                ->where('exam_id', $examID)
                ->where('student_id', $studentID)
                ->exists())
        {
            return $this->table
                        ->select('question_set_id')
                        ->where('exam_id', $examID)
                        ->where('student_id', $studentID)
                        ->update(['student_answers' => $answers]);
        }
    }   
}
