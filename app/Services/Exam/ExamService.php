<?php
namespace App\Services\Exam;

use App\Repositories\ExamRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;


class ExamService {
    protected $examRepository;
    protected $questionRepository;


    public function __construct(ExamRepository $examRepository, QuestionRepository $questionRepository)
    {
        $this->examRepository = $examRepository;
        $this->questionRepository = $questionRepository;
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
        try
        {
            $examID = 'EXAM'.$request->subject.$request->semester.date('Ymdi');
            $this->examRepository->createExam($request, $examID);
            $this->questionRepository->addQuestionsToExam($request, $examID);
        }catch(\Exception $e)
        {
            $this->examRepository->deleteExamById($examID);
            return redirect()->route('get.exam.list')->with('error', 'Cannot create Exam (No Questions avaiable), please report to the administrator to fix this problem');
        }
    }
}
