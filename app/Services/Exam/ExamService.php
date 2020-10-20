<?php
namespace App\Services\Exam;

use App\Repositories\ExamRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\StudentExamRepository;
use App\Repositories\StudentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExamService
{
    protected $examRepository;
    protected $questionRepository;
    protected $studentRepository;
    protected $studentExamRepository;

    public function __construct
    (
        ExamRepository $examRepository,
        QuestionRepository $questionRepository,
        StudentRepository $studentRepository,
        StudentExamRepository $studentExamRepository
    )
    {
        $this->examRepository = $examRepository;
        $this->questionRepository = $questionRepository;
        $this->studentRepository = $studentRepository;
        $this->studentExamRepository = $studentExamRepository;
    }

    public function getStudentExam($studentID)
    {
       return $this->studentExamRepository->getExamByStudentID($studentID);
    }

    public function getExamList()
    {
        return $this->examRepository->getAllExam();
    }

    public function getUpcomingExam()
    {
        return $this->examRepository->getUpcomingExam();
    }

    public function getExamDetail($id)
    {
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
            $question = [];
            $question[] = $this->questionRepository->createQuestionsToExam($request, 'MC4');
            $question[] = $this->questionRepository->createQuestionsToExam($request, 'SC4');
            $question[] = $this->questionRepository->createQuestionsToExam($request, 'TF');
            $exam_question = json_encode($question);
            $this->questionRepository->addQuestionToQuestionExam($examID, $exam_question);
            $class = $request->classroom;
            for($i = 1; $i <= 4; $i++)
            {
                $studentID = $this->studentRepository->getRandomUserByClass($class)->first()->id;
                $question_set = [];
                $question_set[]  = collect($question)->where('type', 'MC4')->random(1);
                $question_set[]  = collect($question)->where('type', 'SC4')->random(1);
                $question_set[]  = collect($question)->where('type', 'TF')->random(1);
                $question_set  = json_encode($question_set);
                $this->studentExamRepository->createStudentExam($studentID, $examID, $examID.$i);
                $this->questionRepository->createQuestionSet($examID.$i, $question_set, $studentID, $request->subject);
            }
            return true;
        }catch(\Exception $e)
        {
            Log::error($e);
            $this->examRepository->deleteExamById($examID);
            return false;
        }
    }

    public function getExamStatus($id)
    {
        try
        {
            $exam = DB::table('exams')->select('start_at', 'duration')->where('id', $id)->first();
            $hours = Carbon::parse($exam->duration)->format('H');
            $minutes = Carbon::parse($exam->duration)->format('i');
            $exam_expired_time = Carbon::parse($exam->start_at)->addDay(0)->addHour($hours)->addMinutes($minutes);
            if( (strtotime(Carbon::now()) - strtotime($exam_expired_time)) > 1)
            {
                return 3;
            }
            return 1;
        }catch(\Exception $e)
        {
            return false;
            Log::error($e);
        }
    }

    public function checkExamStartTime($id)
    {
        try
        {
            $exam = DB::table('exams')->select('start_at')->where('id', $id)->first();
            if( (strtotime(Carbon::now()) - strtotime(Carbon::parse($exam->start_at))) > 1)
            {
                return true;
            }
        }catch(\Exception $e)
        {
            return false;
            Log::error($e);
        }
    }
}
