<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Services\Exam\ExamService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\examRequest;


class ExamController extends Controller
{
    protected $examService;

    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }

    public function getExamDetail($examID)
    {
        $exam = $this->examService->getExamDetail($examID);
        $exam_questions = $this->examService->getExamQuestions($examID);
        return view('Admin.pages.exam_detail', compact('exam', 'exam_questions'));
    }

    public function getUpcomingExam()
    {
        $exam = $this->examService->getUpcomingExam();
        return view('Admin.pages.exam_detail', compact('exam'));
    }

    public function getExamList()
    {
        $listExam = DB::table('exams')->orderBy('created_at', 'desc')->paginate(6);
        return view('Admin.pages.exam_list', compact('listExam'));
    }

    public function create(){
        return view('Admin.pages.create_exam');
    }

    public function store(examRequest $request)
    {
        if($this->examService->createNewExam($request))
        {
            return redirect()->route('get.exam.list')->with('success', 'You has successfully created the exam');
        }
        return redirect()->route('get.exam.list')->with('error', 'Cannot create Exam (No Questions avaiable), please report to the administrator to fix this problem');
    }

}
