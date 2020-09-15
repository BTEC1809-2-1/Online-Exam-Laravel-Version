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
use Carbon\Carbon;

class QuestionController extends Controller
{
    protected $questionService;

    public function __construct(QuestionService $questionService){
        $this->middleware('auth');
        $this->questionService = $questionService;
    }
    public function create(){
        return view('Admin.pages.create_question');
    }
    public function delete($id){
        $question = Question::find($id);
        $question->delete();
        return redirect()->route('get.question.list');
    }
    public function store(Request $request){
        try {
            $date =  date('Ymd')+date('Hsi');
            $question = new Question();
            $question->id = $request->subject.$request->questionType.$date;
            $question->question = $request->question;
            $question->type = $request->questionType;
            $question->subject = $request->subject;
            $question->created_by = $request->user()->name;
            $question->save();
            $questionId = $request->subject.$request->questionType.$date;
            $this->storeAnswer($request, $questionId);
        }catch(\Exception $e){
            return redirect()->route('get.question.list')->with('error', 'There are problem with your input data, the question has not been added to the database');
        }
        return redirect()->route('home');
    }
    public function getQuestionList(){
        $listQuestion = $this->questionService->getQuestionList();
        return view('Admin.pages.question_list', compact('listQuestion'));
    }
    public function getQuestionDetail($id){
        $question = $this->questionService->getQuestionDetail($id);
        return view('Admin.pages.question_detail', compact('question'));
    }
    public function storeAnswer(Request $request, $questionId){
        try{
            foreach($request->answer as $index=>$ans){
                $answer = new Answer();
                $answer->id = $questionId.$index;
                $answer->question_id = $questionId;
                $answer->answer = $request->answer[$index];
                $answer->created_by = $request->user()->name;
                $answer->updated_by = $request->user()->name;
                $answer->save();
            }
        }catch(\Exception $e){
            return redirect()->route('home')->with('error', 'There are problem with your input data, the Answer has not been added to the database');
        };
    }

}
