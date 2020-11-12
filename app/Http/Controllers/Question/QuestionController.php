<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Question\QuestionService;
use App\Http\Requests\questionRequest;

//TODO: change description
/*
|--------------------------------------------------------------------------
| Login Controller
|--------------------------------------------------------------------------
|
| This controller handles authenticating users for the application and
| redirecting them to your home screen. The controller uses a trait
| to conveniently provide its functionality to your applications.
|
*/

class QuestionController extends Controller
{
    protected $questionService;
    protected $answerService;


    /**
     * @param QuestionService $questionService
     */
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    /**
     * Show create question page
     */
    public function create()
    {
        return view('Admin.pages.create_question');
    }

    /**
     * @param mixed $questionID
     *
     * @return [type]
     */
    public function delete($questionID)
    {
        if($this->questionService->deleteQuestionByID($questionID))
        {
            return redirect()->route('get.question.list')->with('success', 'You have delete that question');
        }
        return redirect()->route('get.question.list')->with('error', 'Some error has occured, the question you choose has not been deleted!');
    }

    /**
     * Display questions list page
     */
    public function getQuestionList()
    {
        $listQuestion = $this->questionService->getQuestionList();
        return view('Admin.pages.question_list', compact('listQuestion'));
    }

    /**
     * @param mixed $questionID
     *
     * Display question detail page
     *
     * @return view question detail
     */
    public function getQuestionDetail($questionID){
        /** Get the question's detail */
        $question = $this->questionService->getQuestionDetail($questionID);
        /** Get this->questions's answers collection */
        $answers = $this->questionService->getQuestionAnswers($questionID);
        return view('Admin.pages.question_detail')->with(compact('question', 'answers'));
    }

    /**
     * @param questionRequest $request
     *
     * Store questions and it's answers to database
     *
     * @return view question list with status message
     */
    public function store(Request $request){
        if($this->questionService->createQuestion($request))
        {
            return redirect()->route('get.question.list')->with('success', 'The question has been succsesfully add to the system');
        }
        return redirect()->route('get.question.list')->with('error', 'Opps, some errors had been happend, your question has not been created');

    }
}
