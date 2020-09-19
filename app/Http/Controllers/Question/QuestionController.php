<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Question\QuestionService;
use App\Question;
use App\Answer;
use App\Exceptions\Handler;
use Exception;
use PhpParser\Node\Stmt\TryCatch;
use App\Repositories\AnswerRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    protected $questionService;
    protected $answerRepository;
    /*
    *   Contruct service class implementation
    */
    public function __construct(QuestionService $questionService, AnswerRepository $answerRepository){
        $this->middleware('auth');
        $this->questionService = $questionService;
        $this->answerRepository = $answerRepository;
    }

    /**
    *  Create basic CRUD function with question table
    */
    public function create(){
        return view('Admin.pages.create_question');
    }
    public function delete($id){
        $this->answerRepository->delete($id);
        $question = Question::find($id);
        $question->delete();
        return redirect()->route('get.question.list')->with('success', 'You have delete that question');
    }
    public function getQuestionList(){
        $listQuestion = $this->questionService->getQuestionList();
        return view('Admin.pages.question_list', compact('listQuestion'));
    }
    public function getQuestionDetail($id){
        $question = $this->questionService->getQuestionDetail($id);
        $answers = $this->answerRepository->getAnswers($id);
        return view('Admin.pages.question_detail')
            ->with(compact('question', 'answers'));
    }

    /**
    *   Involke new question object, try to get data from $_POST request
    *   If the request is valid, call eloquent save() function to save the question
    *   And then call storeAnswer to save answers of $this.Question
    *   If the answer is insert to table successfully, redirect to question's details
    *   Else, delete $this.Question and redirect to question list with error
    */
    public function store(Request $request){
        $question_id = '';
        try {
            $date =  date('Ymd')+date('Hsi');
            $question = new Question();
            $question->id = $request->subject.$request->questionType.$date;
            $question_id =  $question->id;
            $question->question = $request->question;
            $question->type = $request->questionType;
            $question->subject = $request->subject;
            $question->created_by = $request->user()->name;
            $data = [];
            $_is_correct = 0;
            if($question->save()){
                try{
                    foreach($request->answer as $index=>$answer){
                        foreach($request->is_correct as $icIndex=>$ic){
                            if($icIndex==$index && $request->is_correct[$index]==1){
                                $_is_correct = 1;
                            }
                            else{
                                $_is_correct = 0;
                            }
                        };
                        $data += [
                            $index => [
                                'id' => $request->subject.$request->questionType.$date.$index,
                                'question_id' => $request->subject.$request->questionType.$date,
                                'answer' => $request->answer[$index],
                                'is_correct' => $_is_correct,
                                'created_by' => Auth::user()->name,
                                'created_at' => now(),
                                'updated_by' => Auth::user()->name,
                                'updated_at' => now(),
                            ]
                        ];
                    }
                    Answer::insert($data);
                }catch(\Exception $e){
                    return redirect()->route('get.question.list')->with('error', 'Answer');
                }
            };
            return redirect()->route('get.question.list')->with('success', 'Add successfully');
        }catch(\Exception $e){
            return redirect()->route('get.question.list')->with('error', 'Chiu');
        }
    }
}
