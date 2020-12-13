<?php

namespace App\Repositories;

use App\Question;
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
                        ->paginate(8);
        return $listExam;
    }


    public function countAllQuestionInDatabase()
    {
        return $this->model->count();
    }

    public function countNumberOfQuestionBySubjectAndLevelOfDifficultAndType($subject, $type, $level_of_difficult)
    {
        return $this->model->where('subject', $subject)
                ->where('type', $type)
                ->where('level_of_difficult', $level_of_difficult)
                ->count();
    }

    public function countNumberOfQuestionBySubjectAndType($subject, $type)
    {
        return $this->model->where('subject', $subject)->where('type', $type)->count();
    }

    public function countNumberOfQuestionBySubject($subject)
    {
        return $this->model->where('subject', $subject)->count();
    }

    public function getQuestionDetail($id)
    {
        $query = $this->query()
                    ->addSelect('level_of_difficult',
                                'created_at',
                                'created_by',
                                'updated_at',
                                'updated_by'
                    );
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
        return DB::table('questions')->select('id', 'question', 'type', 'level_of_difficult')
                    ->where('subject', $subject)
                    ->where('level_of_difficult', $level_of_difficult)
                    ->inRandomOrder()
                    ->limit($number_of_questions)
                    ->get()
                    ->toArray();
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

    public function updateDetail($request, $questionID)
    {
        return Question::where('id', $questionID)->update([
            'question' => $request->question,
            'level_of_difficult' => $request->level_of_difficult
        ]);
    }

}

