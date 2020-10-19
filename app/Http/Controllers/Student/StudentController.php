<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\Exam\ExamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    Protected $examService;

    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }


    public function showReadyPage()
    {
        $exam = $this->examService->getStudentExam(Auth::user()->id);
        $status = $this->examService->getExamStatus($exam->id);
        return view('Student.pages.ready', compact('exam', 'status'));
    }

    public function showDoExamPage($id)
    {
        // dd($this->examService->checkExamStartTime($id));
        if($this->examService->checkExamStartTime($id))
        {
            $exam = $this->examService->getStudentUpcomingExam($id);
            return view('Student.pages.do-exam')->with(compact('exam'));
        }
        return redirect()->route('student');

    }

    public function submitExam(Request $request)
    {

    }

}
