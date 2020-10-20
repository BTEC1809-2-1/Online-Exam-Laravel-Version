<?php
namespace App\Services\Exam;

use App\Repositories\ExamRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\StudentExamRepository;
use App\Repositories\StudentRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

use function GuzzleHttp\json_decode;

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
            $class = $request->classroom;
            $subject = $request->subject;
            $studentID = null;
            if ($this->studentRepository->getRandomUserByClass($class) !== null) {
                $studentID = $this->studentRepository->getRandomUserByClass($class)->id;
            };
            $this->examRepository->createExam($request, $examID);
            $questions = $this->addQuestionToExam($request, $examID);
            $this->createQuestionSetFromExamQuestions($examID, $questions, 4, $studentID, $subject);
            $this->studentExamRepository->addStudentToExam($studentID, $examID, $question_set_id);
            return true;
        }catch(\Exception $e)
        {
            Log::error($e);
            $this->examRepository->deleteExamById($examID);
            return false;
        }
    }

    function addQuestionToExam($request, $examID)
    {
        try
        {
            $exam_question_id = 'EQ'.$request->subject.Str::random(10);
            $question = [];
            $question[] = $this->questionRepository->createQuestionsToExam($request, 'MC4');
            $question[] = $this->questionRepository->createQuestionsToExam($request, 'SC4');
            $question[] = $this->questionRepository->createQuestionsToExam($request, 'TF');
            $exam_question = json_encode($question);
            $this->questionRepository->addQuestionToQuestionExam($exam_question_id, $examID, $exam_question);
            return $question;
        }catch(\Exception $e)
        {
            $this->questionRepository->deleteExamQuestionById($exam_question_id);
            Log::error($e);
        }
    }

    function createQuestionSetFromExamQuestions($examID, $question, $numberOfSets, $studentID, $subject)
    {
        try {
            $question_set = [];
            for($i = 1; $i <= $numberOfSets; $i++)
            {
                $setID = $examID.$i;
                $question_set[]  = collect($question[0])->random(3);
                $question_set[]  = collect($question[1])->random(3);
                $question_set[]  = collect($question[2])->random(3);
                $question_set  = json_encode($question_set);
                $this->questionRepository->createQuestionSet($setID, $question_set, $studentID, $subject);
            }
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    function addStudentToExam($examID, $studentID)
    {

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
