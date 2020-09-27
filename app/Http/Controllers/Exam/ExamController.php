<?php

namespace App\Http\Controllers\Exam;

use App\Exam;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;
use App\Services\Exam\ExamService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

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
        $question_ids = DB::table('exam_questions')->select('question_id')
                        ->where('exam_id', $id)
                        ->get();
        $questions = [];
        foreach($question_ids as $qIndex=>$question_id){
            $question =  DB::table('questions')->select('question')->where('id', $question_id->question_id)->get();
            $questions += [
                $qIndex => $question[0]->question
            ];
        }
        return view('Admin.pages.exam_detail', compact('exam', 'questions'));
    }

    public function getUpcomingExam(){
        $exam = $this->examService->getUpcomingExam();
        return view('Admin.pages.exam_detail', compact('exam'));
    }

    public function getExamList(){
        $listExam = DB::table('exams')->paginate(6);
        return view('Admin.pages.exam_list', compact('listExam'));
    }

    public function create(){
        return view('Admin.pages.create_exam');
    }

    public function store(Request $request){
        // dd($request);
        $exam = new Exam();
        $exam->id = 'EXAM'.$request->subject.$request->semester.date('Ymdi');
        $examID = $exam->id;
        $exam->semester = $request->semester;
        $exam->duration = $request->duration;
        $exam->start_at = date($request->date.' '.$request->startTime);
        $exam->classroom = $request->classroom;
        $exam->subject = $request->subject;
        $exam->status = 0;
        $exam->save();
        $question_set = [];
        $questions = DB::table('questions')->select('id')
                    ->where('subject', 'like', $request->subject)
                    ->get()
                    ->random(2);
        foreach($questions as $qIndex=>$question){
            $question_set += [
                $qIndex => [
                    'id' => 'EQ'.$request->subject.date('md').$qIndex,
                    'exam_id' => $examID,
                    'question_id' => $question->id,
                    'created_by' => Auth::user()->name,
                    'created_at' => now(),
                    'updated_by' => Auth::user()->name,
                    'updated_at' => now(),
                ]
            ];
        };
        DB::table('exam_questions')->insert($question_set);
        return redirect('/Exam/Detail/'.$examID)->with('success', 'You have successfully added this exam');
    }

}
