<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\Exam\ExamService;
use App\Services\Question\QuestionService;
class AnswerController extends Controller
{
    public function index()
    {
        //
        return view('doExam.doExam');
    }
}
