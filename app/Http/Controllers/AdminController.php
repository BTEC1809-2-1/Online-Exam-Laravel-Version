<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Exam\ExamService;
use App\Services\Question\QuestionService;
class AdminController extends Controller
{
    protected $examService;
    protected $questionService;

    public function __construct(ExamService $examService, QuestionService $questionService)
    {
        $this->examService = $examService;
        $this->questionService = $questionService;
    }

    public function index(){
        $listExam = $this->examService->getUpcomingExam();
        return view('Admin.pages.admin-dashboard', compact('listExam'));
    }
}
