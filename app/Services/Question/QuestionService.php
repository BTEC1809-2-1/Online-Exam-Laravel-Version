<?php

namespace App\Services\Question;

use App\Repositories\AnswerRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

class QuestionService {

    protected $questionRepository;
    protected $answerRepository;

    public function __construct(QuestionRepository $questionRepository, AnswerRepository $answerRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
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
        $this->answerRepository->deleteAllAnswerByQuestionID($questionID);
        $this->questionRepository->deleteByID($questionID);
    }
}

