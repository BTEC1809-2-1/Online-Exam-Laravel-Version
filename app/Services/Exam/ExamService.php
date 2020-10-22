<?php
namespace App\Services\Exam;

use App\Repositories\ExamRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\QuestionSetRepository;
use App\Repositories\StudentExamRepository;
use App\Repositories\StudentRepository;
use Carbon\Carbon;
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
    protected $questionSetRepository;

    public function __construct
    (
        ExamRepository $examRepository,
        QuestionRepository $questionRepository,
        StudentRepository $studentRepository,
        StudentExamRepository $studentExamRepository,
        QuestionSetRepository $questionSetRepository
    )
    {
        $this->examRepository = $examRepository;
        $this->questionRepository = $questionRepository;
        $this->studentRepository = $studentRepository;
        $this->studentExamRepository = $studentExamRepository;
        $this->questionSetRepository = $questionSetRepository;
    }

    public function getStudentExam($studentID)
    {
       return $this->studentExamRepository
                    ->getExamByStudentID($studentID);
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
        return $this->questionRepository
                        ->getQuestionsByExam($examID);
    }

    public function createNewExam(Request $request)
    {
        try
        {
            $examID = 'EXAM'.$request->subject.
                        $request->semester.
                            date('YmdHis');
            $class = $request->classroom;
            $subject = $request->subject;
            $this->examRepository->createExam($request, $examID);
            $questions = $this->addQuestionToExam($request, $examID);
            $number_of_set_required = 4;
            $this->createQuestionSetFromExamQuestions
            (
                $examID,
                $class,
                $questions,
                $number_of_set_required,
                $subject
            );
            $studentInClass = $this->studentRepository->getAllStudentByClass($class);
            $studentID = [];
            foreach($studentInClass as $student)
            {
                $studentID[] = $student->id;
            }
            $this->addStudentToExam($examID, $class, $studentID);
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
            $question[] = $this->questionRepository
                                ->createQuestionsToExam($request, 'MC4');
            $question[] = $this->questionRepository
                                ->createQuestionsToExam($request, 'SC4');
            $question[] = $this->questionRepository
                                ->createQuestionsToExam($request, 'TF');
            $exam_question = json_encode($question);
            $this->questionRepository
                    ->addQuestionToQuestionExam(
                        $exam_question_id,
                        $examID,
                        $exam_question
            );
            return $question;
        }catch(\Exception $e)
        {
            $this->questionRepository
                    ->deleteExamQuestionById($exam_question_id);
            Log::error($e);
        }
    }

    function createQuestionSetFromExamQuestions(
        $examID, $class,
        $question, $numberOfSets,
        $subject)
    {
        try {
            $studentInClass = $this->studentRepository->getAllStudentByClass($class);
            $studentInSet = [];
            foreach($studentInClass as $student)
            {
                $studentInSet[] = $student->id;
            }
            $studentID = [
                '1' => '',
                '2' => '',
                '3' => '',
                '4' => ''
            ];
            for($index = 1; $index <= 4; $index++)
            {
                if(count($studentInSet) > 2)
                {
                    $randomKeys = array_rand($studentInSet, 2);
                    $studentID[$index] = [
                        $studentInSet[$randomKeys[0]],
                        $studentInSet[$randomKeys[1]]
                    ];
                    $removeValue1 = $studentInSet[$randomKeys[0]];
                    $removeValue2 = $studentInSet[$randomKeys[1]];
                    unset($studentInSet[array_search($removeValue1, $studentInSet)]);
                    unset($studentInSet[array_search($removeValue2, $studentInSet)]);

                }else
                {
                    $studentID[$index] = [$studentInSet];
                    $removeValue = $studentInSet;
                    unset($studentInSet[array_search($removeValue, $studentInSet)]);
                }
            }
            $question_set = [];
            for($i = 1; $i <= $numberOfSets; $i++)
            {
                $setID = $examID.$i;
                /**
                 * After received a question choosen for the exam as
                 * a collection, the questions are separated by type as
                 *  =>  0: SC4;
                 *  =>  1: TF;
                 *  =>  2: MC4;
                 * To generate different question sets for the exam,
                 * We random three question (demo only) and add them
                 * to the set.
                 */
                $question_set  = collect($question[0])->random(3);
                $question_set  = collect($question[1])->random(3);
                $question_set  = collect($question[2])->random(3);
                $question_set  = json_encode($question_set);
                $this->questionSetRepository
                        ->createQuestionSet(
                            $setID,
                            $question_set,
                            json_encode($studentID[$i]),
                            $subject
                );

            }
        } catch (\Exception $e) {
            Log::error($e);
            return;
        }
    }

    function addStudentToExam($examID, $class, $studentIDs)
    {
        try {
            $examQuestionSets = $this->questionSetRepository->getQuestionSetByExam($examID);
            $examQuestionSets = json_decode(json_encode($examQuestionSets));
            $examSets = [];
            foreach($examQuestionSets as $question_set)
            {
                $examSets[] = [
                  'id' =>  $question_set->id,
                  'student_id' => $question_set->student_id
                ];
            }
            foreach($studentIDs as $studentID)
            {
                $question_set_id = '';
                foreach($examSets as $set)
                {
                    if(in_array($studentID, json_decode($set['student_id'])) !== false)
                    {
                        $question_set_id = $set['id'];
                        break;
                    }
                }
                $this->studentExamRepository
                    ->addStudentToExam(
                        $studentID,
                        $examID,
                        $question_set_id
                );
            }
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    public function getExamStatus($id)
    {
        try
        {
            $exam = DB::table('exams')
                        ->select('start_at', 'duration')
                        ->where('id', $id)
                        ->first();
            $hours = Carbon::parse($exam->duration)->format('H');
            $minutes = Carbon::parse($exam->duration)->format('i');
            $exam_expired_time = Carbon::parse($exam->start_at)
                                        ->addDay(0)
                                        ->addHour($hours)
                                        ->addMinutes($minutes);
            if( (strtotime(Carbon::now())
                    - strtotime($exam_expired_time)) > 1)
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
            $exam = DB::table('exams')
                    ->select('start_at')
                    ->where('id', $id)
                    ->first();
            if( (strtotime(Carbon::now())
                    - strtotime(Carbon::parse($exam->start_at))) > 1)
            {
                return true;
            }
        }catch(\Exception $e)
        {
            Log::error($e);
            return false;
        }
    }

    public function getStudentExamQuestions($examID, $studentID)
    {
        try {
            $question_set_id = $this->studentExamRepository
                                        ->getStudentQuestionSet($examID, $studentID);
            $questions = $this->questionSetRepository
                                    ->getQuestionsBySetId($question_set_id);
            $questions = json_decode($questions);
            dd($questions);
            foreach($questions as $question)
            {
                $question->answer = json_decode($this->questionRepository
                                        ->getQuestionsAndAnswers($question->id));
            }
            return $questions;
        } catch (\Exception $e) {
           Log::error($e);
           return null;
        }
    }
}
