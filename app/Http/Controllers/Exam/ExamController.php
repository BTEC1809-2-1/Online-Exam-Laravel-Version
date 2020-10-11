<?php

namespace App\Http\Controllers\Exam;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;
use App\Services\Exam\ExamService;
use Illuminate\Support\Facades\DB;


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

    public function store(Request $request)
    {
        return $this->examService->createNewExam($request);
    }

}
