<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Question\QuestionService;
use App\Http\Requests\questionRequest;

class QuestionController extends Controller
{
    protected $questionService;
    protected $answerService;


    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function create()
    {
        return view('Admin.pages.create_question');
    }

    public function delete($questionID)
    {
        if($this->questionService->deleteQuestionByID($questionID))
        {
            return redirect()->route('get.question.list')->with('success', 'You have delete that question');
        }
        return redirect()->route('get.question.list')->with('error', 'Some error has occured, the question you choose has not been deleted!');
    }

    public function getQuestionList()
    {
        $listQuestion = $this->questionService->getQuestionList();
        return view('Admin.pages.question_list', compact('listQuestion'));
    }

    public function getQuestionDetail($questionID){
        $question = $this->questionService->getQuestionDetail($questionID);
        $answers = $this->questionService->getQuestionAnswers($questionID);
        return view('Admin.pages.question_detail')
            ->with(compact('question', 'answers'));
    }

    public function store(questionRequest $request){
        // if($this->questionService->createQuestion($request))
        // {
        //     return redirect()->route('get.question.list')->with('success', 'The question has been succsesfully add to the system');
        // }
        // return redirect()->route('get.question.list')->with('error', 'Opps, some errors had been happend, your question has not been created');

    }
}
