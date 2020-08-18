<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Exam\ExamService;

class ExamController extends Controller
{
    protected $examService;

    public function __construct(ExamService $examService)
    {
        $this->middleware('auth');
        $this->examService = $examService;
    }

    public function getExamDetail($id){
        $exam = $this->examService->getExamDetail($id);
        return view('Admin.exam_detail', compact('exam'));
    }

    public function getUpcomingExam(){
        $exam = $this->examService->getUpcomingExam();
        return view('Admin.exam_detail', compact('exam'));
    }

    public function getExamList(){
        $listExam = $this->examService->getExamList();
        return view('Admin.exam_list', compact('listExam'));
    }

    public function create(){
        return view('Admin.create_exam');
    }

    public function storageExam(){
        //$this->examService->storageExam();
    }

}
