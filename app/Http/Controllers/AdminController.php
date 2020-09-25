<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Exam\ExamService;
use App\Services\Question\QuestionService;
class AdminController extends Controller
{
    protected $examService;
    protected $questionService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ExamService $examService, QuestionService $questionService)
    {
        $this->middleware('auth');
        $this->examService = $examService;
        $this->questionService = $questionService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index(){
        $listExam = $this->examService->getUpcomingExam();
        $listQuestion = $this->questionService->getRecentlyAddedQuestion();
        return view('Admin.pages.admin-dashboard', compact('listExam','listQuestion'));
    }
}
