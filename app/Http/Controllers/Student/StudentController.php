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
        return view('Student.pages.ready', compact('exam'));
    }

    public function showDoExamPage()
    {
        return view('Student.pages.do-exam');
    }

    public function submitExam(Request $request)
    {

    }

}
