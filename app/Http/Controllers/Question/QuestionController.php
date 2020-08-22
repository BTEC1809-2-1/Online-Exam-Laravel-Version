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

class QuestionController extends Controller
{
    protected $questionService;


    public function __construct(QuestionService $questionService){

        $this->questionService = $questionService;

    }

    public function create(){

        return view('Admin.create_question');

    }

    public function delete($id){

        $question = Question::find($id);
        $question->delete();
        return redirect()->route('home');
    }

    public function store(Request $request){

        try {
            $question = new Question();
            $question->id = $request->id;
            $question->question = $request->question;
            $question->type = $request->type;
            $question->subject = $request->subject;
            $question->created_by = $request->user()->name;
            $question->save();
        }catch(\Exception $e){
            return redirect()->route('home')->with('error', 'There are problem with your input data, the question has not been added to the database');
        }

        return redirect()->route('home');
    }

    public function getQuestionList(){

        $listQuestion = $this->questionService->getQuestionList();
        return view('Admin/question_list', compact('listQuestion'));

    }

    public function getQuestionDetail($id){

        $question = $this->questionService->getQuestionDetail($id);
        return view('Admin.question_detail', compact('question'));

    }

    public function addAnswer($id){

        $question = Question::find($id, ['id','type','question']);
        // print_r($question_type);
        return view('Admin.add_answer', compact('question'));
    }

    public function storeAnswer(Request $request){

        // dd($request->question_id);
        $count = count($request->answer);

        for($i = 0; $i < $count; $i++){
            $answer = new Answer();
            $answer->id = $request->question_id + $i +1;
            $answer->answer = $request->answer[$i];
            $answer->question_id = $request->question_id;
            $answer->is_correct = $request->is_correct[$i];
            $answer->created_by = auth()->user()->name;
            $answer->updated_by = auth()->user()->name;
            // dd($answer);
            $answer->save();
        }
        return redirect()->route('get.question.list');

    }

}
