<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\Question\QuestionService;
use App\Services\Exam\ExamService;
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
        if($exam = $this->examService->getStudentExam(Auth::user()->id) !== null)
        {
            $id = $exam->id;
            $subject = $exam->subject;
            $start_at = date('H:i:s', strtotime($exam->start_at));
            $duration =$exam->duration;
            $countdown = Carbon\Carbon::now()->diffInMinutes(Carbon\Carbon::parse($exam->start_at));
            $status = $this->examService->getExamStatus($exam->id);
            return view('Student.pages.ready', compact('exam', 'id' ,'status', 'start_at', 'duration', 'countdown', 'subject'));
        }
        return view('Student.pages.ready');
    }

    public function showDoExamPage($id)
    {
        if($this->examService->checkExamStartTime($id))
        {
            $exam = $this->examService->getStudentUpcomingExam($id);
            $questions = $this->questionService->getExamQuestions();
            return view('Student.pages.do-exam')->with(compact('exam'));
        }
        return redirect()->route('student');
    }

    public function submitExam(Request $request)
    {

    }
}
