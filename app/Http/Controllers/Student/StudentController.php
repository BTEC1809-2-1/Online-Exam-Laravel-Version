<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\Question\QuestionService;
use App\Services\Exam\ExamService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    Protected $examService;
    Protected $questionService;

    public function __construct
    (
        ExamService $examService,
        QuestionService $questionService
    )
    {
        $this->examService = $examService;
        $this->questionService =$questionService;
    }

    public function showReadyPage()
    {
        if($this->examService->getStudentExam(Auth::user()->id) !== null)
        {
            $exam = $this->examService->getStudentExam(Auth::user()->id);
            $id = $exam->id;
            $subject = $exam->subject;
            $start_at = date('H:i:s', strtotime($exam->start_at));
            $duration =$exam->duration;
            $countdown = Carbon::now()->diffInMinutes(Carbon::parse($exam->start_at));
            $status = $this->examService->getExamStatus($exam->id);
            return view('Student.pages.ready', compact('exam', 'id' ,'status', 'start_at', 'duration', 'countdown', 'subject'));
        }
        return view('Student.pages.ready');
    }

    public function showDoExamPage($id)
    {
        // if($this->examService->checkExamStartTime($id))
        // {
            $exam = $this->examService->getStudentExam($id);
            $questions = $this->examService->getStudentExamQuestions($exam->id, $id);
            dd($questions);
            return view('Student.pages.do-exam')->with(compact('exam', 'questions'));
        // }
        // return redirect()->route('student');
    }

    public function submitExam(Request $request)
    {

    }
}
