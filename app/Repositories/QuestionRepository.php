<?php

namespace App\Repositories;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuestionRepository extends BaseRepository {
  public function model()
    {
        return Question::class;
    }

    public function query()
    {
        $query = $this->model->select(
            'id',
            'question',
            'type',
            'subject'
        );
        return $query;
    }

    public function saveQuestion(Request $request, $questionID)
    {
        $question = new Question();
        $question->id = $questionID;
        $question->question = $request->question;
        $question->type = $request->questionType;
        $question->subject = $request->subject;
        $question->created_by = Auth::user()->name;
        $question->updated_by = Auth::user()->name;
        $question->save();
    }

    public function getAllQuestion()
    {
        $listExam = DB::table('questions')->paginate(5);
        return $listExam;
    }

    public function getRecentlyAddedQuestion(){

        $listExam = DB::table('questions')->limit(3)->get();
        return $listExam;

    }

    public function getQuestionDetail($id)
    {
        $query = $this->query()->addSelect('created_at', 'created_by', 'updated_at', 'updated_by');
        return $query->findOrFail($id);
    }

    public function getQuestionsByExam($examID)
    {
        $question_ids = DB::table('exam_questions')->select('question_id')
            ->where('exam_id', $examID)
            ->get();
        $questions = [];
            foreach($question_ids as $qIndex=>$question_id){
                $question =  DB::table('questions')
                    ->select('question')
                    ->where('id', $question_id->question_id)
                    ->get();
                $questions += [
                    $qIndex => $question[0]->question
            ];
        }
    }

    public function addQuestionsToExam(Request $request, $examID)
    {
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
    }

    public function deleteByID($questionID)
    {
        $question = Question::find($questionID);
        $question->delete();
    }
}
