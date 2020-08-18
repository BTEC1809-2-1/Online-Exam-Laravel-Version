<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Question\QuestionService;

class QuestionController extends Controller
{
    protected $questionService;

    public function __construct(QuestionService $questionService){

        $this->questionService = $questionService;

    }

    public function create(){

        return view('Admin.create_question');

    }

    public function storage(){

    }

    public function getQuestionList(){

        $listQuestion = $this->questionService->getQuestionList();
        return view('Admin/question_list', compact('listQuestion'));

    }

    public function getQuestionDetail($id){

        $question = $this->questionService->getQuestionDetail($id);
        return view('Admin.question_detail', compact('question'));

    }

}
