<?php
namespace App\Services\Question;

use App\Repositories\AnswerRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\QuestionSetRepository;
use App\Repositories\ExamQuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuestionService {

    protected $questionRepository;
    protected $answerRepository;
    protected $examQuestionRepository;
    protected $questionSetRepository;

    public function __construct
    (
        QuestionRepository $questionRepository, 
        AnswerRepository $answerRepository,
        ExamQuestionRepository $examQuestionRepository,
        QuestionSetRepository $questionSetRepository
    )
    {
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->examQuestionRepository = $examQuestionRepository;
        $this->questionSetRepository =$questionSetRepository;
    }

    public function createQuestion(Request $request)
    {
        $date =  date('Ymd')+date('Hsi');
        $questionID = 'Q'.$request->subject.$request->questionType.$date;
        try
        {
            $this->questionRepository->saveQuestion($request, $questionID);
            switch($request->questionType)
            {
                case 'SC4':
                    $this->answerRepository->saveSingleChoiceOrTrueFalseQuestionAnswers($request, $questionID, $date);
                break;
                case 'MC4':
                    $this->answerRepository->saveMultipleQuestionAnswers($request, $questionID, $date);
                break;
                case 'TF':
                    $this->answerRepository->saveSingleChoiceOrTrueFalseQuestionAnswers($request, $questionID, $date);
                break;
            }
            return true;
        }catch(\Exception $e)
        {
            Log::error($e);
            $this->deleteQuestionByID($questionID);
            return false;
        }
    }

    public function getQuestionAnswers($questionID)
    {
        $answers = $this->answerRepository->getAnswers($questionID);
        return $answers;
    }

    public function getQuestionList()
    {
        return $this->questionRepository->getAllQuestion();
    }

    public function getRecentlyAddedQuestion()
    {
        return $this->questionRepository->getRecentlyAddedQuestion();
    }

    public function getQuestionDetail($id)
    {
        return $this->questionRepository->getQuestionDetail($id);
    }

    public function deleteQuestionByID($questionID)
    {
        try
        {
            $this->answerRepository->deleteAllAnswerByQuestionID($questionID);
            $this->questionRepository->deleteByID($questionID);
        }catch(\Exception $e)
        {
            Log::error($e);
        }
    }

    public function getExamQuestions($examID, $studentID)
    {
        try
        {
            $questions = [];
            $question_set =  $this->questionSetRepository->getQuestionSetByExam($examID, $studentID);
            foreach($question_set as $question)
            {
                $questions[] = $this->questionRepository->getExamQuestionsAndAnswers($examID);
            }
            return $questions;
        }catch(\Exception $e)
        {
            Log::error($e);
        }
    }
}

