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

    public function saveQuestion($request, $questionID)
    {
        $question = new Question();
        $question->id = $questionID;
        $question->question = $request->question;
        $question->type = $request->questionType;
        $question->subject = $request->subject;
        $question->level_of_difficult = $request->difficulity;
        $question->created_by = Auth::user()->name;
        $question->updated_by = Auth::user()->name;
        $question->save();
    }

    public function getAllQuestion()
    {
        $listExam = DB::table('questions')
                        ->orderBy('created_at', 'desc')
                        ->paginate(5);
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
        return DB::table('exam_questions')
                ->select('question_id')
                ->where('exam_id', $examID)
                ->first()
                ->question_id ?? null;
    }

    public function addQuestionsToExamByDifficultyAndNumberOfQuestionsRequired($subject, $level_of_difficult, $number_of_questions)
    {
        return DB::table('questions')->select('id', 'question', 'type', 'level_of_difficult')->where('subject', $subject)->where('level_of_difficult', $level_of_difficult)->inRandomOrder()->limit($number_of_questions)->get()->toArray();
    }

    public function deleteByID($questionID)
    {
        $question = Question::find($questionID);
        $question->delete();
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

    public function getQuestionCorrectAnswer($questionID)
    {
        return DB::table("questions")
                ->join("answers", "questions.id", "=", "answers.question_id")
                ->select("answers.is_correct")
                ->where('questions.id', $questionID)
                ->first();

    }

}

