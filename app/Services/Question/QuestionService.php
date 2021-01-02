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
    public function createQuestion($request, $questionID, $date)
    {
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

    public function updateQuestionDetail($request, $questionID)
    {
        $this->answerRepository
             ->updateDetail($request, $questionID);

        return $this->questionRepository
            ->updateDetail($request, $questionID);

    }
    public function getDatabaseStatistic()
    {
        return [
            'total'=> [
                'All Type' => $this->questionRepository->countAllQuestionInDatabase(),
                'IT' => $this->questionRepository->countNumberOfQuestionBySubject('IT'),
                'BM' => $this->questionRepository->countNumberOfQuestionBySubject('BM'),
                'GD' => $this->questionRepository->countNumberOfQuestionBySubject('GD'),
            ],
            'detail' => [
                'IT' => [
                    'True False' => [
                        'total' => $this->questionRepository->countNumberOfQuestionBySubjectAndType('IT', 'TF'),
                        'normal' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'IT',
                                                'TF',
                                                config('app.question_level_of_difficult.normal')
                                            ),
                        'medium' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'IT',
                                                'TF',
                                                config('app.question_level_of_difficult.medium')
                                            ),
                        'hard'   => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'IT',
                                                'TF',
                                                config('app.question_level_of_difficult.hard')
                                            ),
                    ],
                    'Multiple Choices Of 4' => [
                        'total' => $this->questionRepository->countNumberOfQuestionBySubjectAndType('IT', 'MC4'),
                        'normal' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'IT',
                                                'MC4',
                                                config('app.question_level_of_difficult.normal')
                                            ),
                        'medium' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'IT',
                                                'MC4',
                                                config('app.question_level_of_difficult.medium')
                                            ),
                        'hard'   => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'IT',
                                                'MC4',
                                                config('app.question_level_of_difficult.hard')
                                            ),
                    ],
                    'Single Choice Of 4' => [
                        'total' => $this->questionRepository->countNumberOfQuestionBySubjectAndType('IT', 'SC4'),
                        'normal' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'IT',
                                                'SC4',
                                                config('app.question_level_of_difficult.normal')
                                            ),
                        'medium' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'IT',
                                                'SC4',
                                                config('app.question_level_of_difficult.medium')
                                            ),
                        'hard'   => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'IT',
                                                'SC4',
                                                config('app.question_level_of_difficult.hard')
                                            ),
                    ],
                ],
                'BM' => [
                    'True False' => [
                        'total' => $this->questionRepository->countNumberOfQuestionBySubjectAndType('BM', 'TF'),
                        'normal' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'BM',
                                                'TF',
                                                config('app.question_level_of_difficult.normal')
                                            ),
                        'medium' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'BM',
                                                'TF',
                                                config('app.question_level_of_difficult.medium')
                                            ),
                        'hard'   => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'BM',
                                                'TF',
                                                config('app.question_level_of_difficult.hard')
                                            ),
                    ],
                    'Multiple Choices Of 4' => [
                        'total' => $this->questionRepository->countNumberOfQuestionBySubjectAndType('BM', 'MC4'),
                        'normal' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'BM',
                                                'MC4',
                                                config('app.question_level_of_difficult.normal')
                                            ),
                        'medium' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'BM',
                                                'MC4',
                                                config('app.question_level_of_difficult.medium')
                                            ),
                        'hard'   => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'BM',
                                                'MC4',
                                                config('app.question_level_of_difficult.hard')
                                            ),
                    ],
                    'Single Choice Of 4' => [
                        'total' => $this->questionRepository->countNumberOfQuestionBySubjectAndType('BM', 'SC4'),
                        'normal' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'BM',
                                                'SC4',
                                                config('app.question_level_of_difficult.normal')
                                            ),
                        'medium' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'BM',
                                                'SC4',
                                                config('app.question_level_of_difficult.medium')
                                            ),
                        'hard'   => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'BM',
                                                'SC4',
                                                config('app.question_level_of_difficult.hard')
                                            ),
                    ],
                ],
                'GD' => [
                    'True False' => [
                        'total' => $this->questionRepository->countNumberOfQuestionBySubjectAndType('GD', 'TF'),
                        'normal' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'GD',
                                                'TF',
                                                config('app.question_level_of_difficult.normal')
                                            ),
                        'medium' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'GD',
                                                'TF',
                                                config('app.question_level_of_difficult.medium')
                                            ),
                        'hard'   => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'GD',
                                                'TF',
                                                config('app.question_level_of_difficult.hard')
                                            ),
                    ],
                    'Multiple Choices Of 4' => [
                        'total' => $this->questionRepository->countNumberOfQuestionBySubjectAndType('GD', 'MC4'),
                        'normal' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'GD',
                                                'MC4',
                                                config('app.question_level_of_difficult.normal')
                                            ),
                        'medium' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'GD',
                                                'MC4',
                                                config('app.question_level_of_difficult.medium')
                                            ),
                        'hard'   => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'GD',
                                                'MC4',
                                                config('app.question_level_of_difficult.hard')
                                            ),
                    ],
                    'Single Choice Of 4' => [
                        'total' => $this->questionRepository->countNumberOfQuestionBySubjectAndType('GD', 'SC4'),
                        'normal' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'GD',
                                                'SC4',
                                                config('app.question_level_of_difficult.normal')
                                            ),
                        'medium' => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'GD',
                                                'SC4',
                                                config('app.question_level_of_difficult.medium')
                                            ),
                        'hard'   => $this->questionRepository
                                            ->countNumberOfQuestionBySubjectAndLevelOfDifficultAndType(
                                                'GD',
                                                'SC4',
                                                config('app.question_level_of_difficult.hard')
                                            ),
                    ],
                ],
            ],
        ];
    }
}

