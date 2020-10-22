<?php

namespace App\Repositories;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        $listExam = DB::table('questions')
                        ->limit(3)
                        ->get();
        return $listExam;
    }

    public function getQuestionDetail($id)
    {
        $query = $this->query()
                ->addSelect('created_at',
                            'created_by',
                            'updated_at',
                            'updated_by');
        return $query->findOrFail($id);
    }

    public function getQuestionsByExam($examID)
    {
        $question_ids = DB::table('exam_questions')
                            ->select('question_id')
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

    public function createQuestionsToExam($request, $type)
    {
        $question_set = [];
        $question_set  = DB::table('questions')
                            ->select('id', 'question', 'type')
                            ->where('subject', $request->subject)
                            ->where('type', $type)
                            ->inRandomOrder()->limit(10)
                            ->get();
        return $question_set;
    }

    public function deleteByID($questionID)
    {
        $question = Question::find($questionID);
        $question->delete();
    }

    public function addQuestionToQuestionExam($id, $examID, $questions)
    {
        $data = [
            'id' => $id,
            'exam_id' => $examID,
            'question_id' => json_encode($questions),
            'created_by' => Auth::user()->name,
            'created_at' => now(),
            'updated_by' => Auth::user()->name,
            'updated_at' => now(),
        ];
        DB::table('exam_questions')->insert($data);
    }

    public function getQuestionsAndAnswers($questionID)
    {
        return DB::table("questions")
                ->join("answers", "questions.id", "=", "answers.question_id")
                ->select("questions.*", "answers.answer")
                ->where('questions.id', $questionID)
                ->get();
    }

    public function deleteExamQuestionByID($id)
    {
        DB::table('exam_questions')->where('id', $id)
        ->delete();
    }

}

