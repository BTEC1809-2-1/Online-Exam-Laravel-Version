<?php
namespace App\Services\Exam;

use App\Repositories\ExamRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;


class ExamService {
    protected $examRepository;
    protected $questionRepository;
    protected $studentRepository;

    public function __construct(
        ExamRepository $examRepository,
        QuestionRepository $questionRepository,
        StudentRepository $studentRepository
        )
    {
        $this->examRepository = $examRepository;
        $this->questionRepository = $questionRepository;
        $this->studentRepository = $studentRepository;
    }

    public function getExamList(){
        return $this->examRepository->getAllExam();
    }

    public function getUpcomingExam(){
        return $this->examRepository->getUpcomingExam();
    }

    public function getExamDetail($id){
        return $this->examRepository->getExam($id);
    }

    public function getExamQuestions($examID)
    {
        return $this->questionRepository->getQuestionsByExam($examID);
    }

    public function createNewExam(Request $request)
    {
        $examID = 'EXAM'.$request->subject.$request->semester.date('Ymdi');
        $class = $request->classroom;
        $question = [];
        $this->examRepository->createExam($request, $examID);
        $question[] = $this->questionRepository->createMultipleChoicesQuestionsToExam($request, $examID);
        $question[] = $this->questionRepository->createSingleChoiceQuestionsToExam($request, $examID);
        $question[] = $this->questionRepository->createTrueFalseQuestionsToExam($request, $examID);
        $studentID = $this->studentRepository->getRandomUserByClass($class)->first()->id;
        $this->questionRepository->addQuestionToQuestionExam($examID, $question);
        // try
        // {

        //     // for($i = 0; $i <= 4; $i++)
        //     // {
        //     //     $studentID = $this->studentRepository->getRandomUserByClass($class)->first()->id;
        //     //     $mc4 = $this->questionRepository->getRandomMultipleChoicesQuestion($examID, config('app.numberOfQuestionPerExam.mc4'));
        //     //     $question += $mc4;
        //     //     $sc4 = $this->questionRepository->getRandomSingleChoicesQuestion($examID, config('app.numberOfQuestionPerExam.sc4'));
        //     //     $question += $sc4;
        //     //     $tf = $this->questionRepository->getRandomTrueFalseQuestion($examID, config('app.numberOfQuestionPerExam.tf'));
        //     //     $question += $tf;
        //     //     $this->questionRepository->createQuestionSet($examID, $question, $studentID);
        //     // }
        // }catch(\Exception $e)
        // {
        //     $this->examRepository->deleteExamById($examID);
        //     return redirect()->route('get.exam.list')->with('error', 'Cannot create Exam (No Questions avaiable), please report to the administrator to fix this problem');
        // }
    }
}
