<?php
namespace App\Services\Question;

/**
 * @author Le Viet Binh An
 */
use App\Repositories\AnswerRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\QuestionSetRepository;
use App\Repositories\ExamQuestionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Question services
|--------------------------------------------------------------------------
|
| This is the class contains logic function to processing data and
| operations related to question
|
*/

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

    /**
     * @param Request $request
     *
     * @return [type]
     */
    //OPTIMIZE: This function need to be optimized
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

    /**
     * @param mixed $questionID
     *
     * @return collection question_answers
     */
    public function getQuestionAnswers($questionID)
    {
        $answers = $this->answerRepository->getAnswers($questionID);
        return $answers;
    }

    /**
     * @return [type]
     */
    public function getQuestionList()
    {
        return $this->questionRepository->getAllQuestion();
    }

    /**
     * @return [type]
     */
    public function getRecentlyAddedQuestion()
    {
        return $this->questionRepository->getRecentlyAddedQuestion();
    }

    /**
     * @param mixed $id
     *
     * @return view('Admin.pages.question_detail')
     */
    public function getQuestionDetail($id)
    {
        return $this->questionRepository->getQuestionDetail($id);
    }

    /**
     * @param mixed $questionID
     *
     * @return [type]
     */
    public function deleteQuestionByID($questionID)
    {
        try
        {
            $this->answerRepository->deleteAllAnswerByQuestionID($questionID);
            $this->questionRepository->deleteByID($questionID);
            return true;
        }catch(\Exception $e)
        {
            return false;
            Log::error($e);
        }
    }

    /**
     * @param mixed $examID
     * @param mixed $studentID
     *
     * @return [type]
     */
    public function getExamQuestions($examID, $studentID)
    {
        try
        {
            $questions = [];
            $question_set =  $this->questionSetRepository->getQuestionSetByExam($examID, $studentID);
            foreach($question_set as $question)
            {
                $questions[] = $this->questionRepository->getQuestionsAndAnswers($examID);
            }
            return $questions;
        }catch(\Exception $e)
        {
            Log::error($e);
        }
    }
}

