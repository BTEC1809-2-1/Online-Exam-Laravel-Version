<?php
/** @author: Le Viet Binh An*/

namespace App\Services\Exam;

use App\Repositories\ExamQuestionRepository;
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

/**
 * This class responsible for processing
 * action that related to the exam object
 * (Not the student's exam, but rather the
 * exam itself)
 *
 */
class ExamService
{
    protected $examRepository;
    protected $questionRepository;
    protected $studentRepository;
    protected $studentExamRepository;
    protected $questionSetRepository;
    protected $examQuestionRepository;

    /**
     * Constructing the service class by
     * calling required repository classes
     */
    public function __construct
    (
        ExamRepository $examRepository,
        QuestionRepository $questionRepository,
        StudentRepository $studentRepository,
        StudentExamRepository $studentExamRepository,
        QuestionSetRepository $questionSetRepository,
        ExamQuestionRepository $examQuestionRepository
    )
    {
        $this->examRepository = $examRepository;
        $this->questionRepository = $questionRepository;
        $this->studentRepository = $studentRepository;
        $this->studentExamRepository = $studentExamRepository;
        $this->questionSetRepository = $questionSetRepository;
        $this->examQuestionRepository = $examQuestionRepository;
    }

    /**
     * @param string $studentID
     *
     * @return [examID, subject, start_at, duration] OR return null
     */
    public function getStudentExam($studentID)
    {
       return $this->studentExamRepository->getExamByStudentID($studentID);
    }

    /**
     * @return collection[(collection) Exams (all)]
     */
    public function getExamList()
    {
        return $this->examRepository->getAllExam();
    }

    /**
     * @return collection[(collection)exams, (orderBy(start_at), limit(3))]
     */
    public function getUpcomingExam()
    {
        return $this->examRepository->getUpcomingExam();
    }

    /**
     * @param string $examID
     * @return collection ['semester','classroom','subject','start_at','status']
     */
    public function getExamDetail($examID)
    {
      return $this->examRepository->getExam($examID);
    }

    /**
     * @param string $examID
     * Return questions's information in Exam Detail page
     * @return [type]
    */
    public function getExamQuestions($examID)
    {
        $questions = $this->questionRepository->getQuestionsByExam($examID);
        if(isset($questions))
        {
            return json_decode($questions);
        }
        return null;
    }

    /**
     * @param  $request Request
     * create new exam for a class
     * @return createdStatus == true or false;
     * @throw \Exception error AND delete $this->exam
     */
    public function createNewExam($request)
    {
      try
      {
        /**
         * Generate the exam's ID based on the subject, semester and current dateTime. All exam start with "EXAM" keyword
         * => format: EXAM<subject><semester><dateTime>
         */
        $examID = 'EXAM'.$request->subject.$request->semester.date('YmdHis');
        /** Assign questions to this exam */
        $questions_in_exam = $this->createExamQuestions($request->subject, $request->question_per_set, $request->exam_type);
        /** Insert new exam to database*/
        $this->examRepository->createExam($request, $examID, $questions_in_exam);
        /** Create questions set from questions assigned to this exam */
        $this->createQuestionSetFromExamQuestions($examID,$request->classroom,$questions_in_exam,$request->question_per_set,$request->subject);
        $students_in_exam = $this->getStudentInExam($examID);
        $this->addStudentToExam($examID, $students_in_exam);
        /** Return Create exam status */
        return true;
      }catch(\Exception $e)
      {
        Log::error($e);
        $this->examRepository->deleteExamByID($examID);
        return false;
      }
    }

    /**
     * @param mixed $number_of_questions_per_set
     *
     * @return [type]
     */
    protected function createExamQuestions($subject, $number_of_questions_per_set, $exam_type)
    {
        switch ($number_of_questions_per_set)
        {
            case '10':
                $this->generateRandomQuestionsByDifficulty($subject, 7, 3, 0);
            break;
            case '12':
                $this->generateRandomQuestionsByDifficulty($subject, 7, 4, 1);
            break;
            case '15':
                $this->generateRandomQuestionsByDifficulty($subject, 9, 3, 2);
            break;
            case '30':
                if($exam_type == config('app.exam_type.Normal'))
                {
                    $this->generateRandomQuestionsByDifficulty($subject, 15, 11, 4);
                }
                if($exam_type == config('app.exam_type.Mid-term'))
                {
                    $this->generateRandomQuestionsByDifficulty($subject, 15, 10, 5);
                }
                if($exam_type == config('app.exam_type.Final'))
                {
                    $this->generateRandomQuestionsByDifficulty($subject, 15, 9, 6);
                }
            break;
            case '45':
                if($exam_type == config('app.exam_type.Normal'))
                {
                    $this->generateRandomQuestionsByDifficulty($subject, 25, 15, 5);
                }
                if($exam_type == config('app.exam_type.Mid-term'))
                {
                    $this->generateRandomQuestionsByDifficulty($subject, 20, 20, 5);
                }
                if($exam_type == config('app.exam_type.Final'))
                {
                    $this->generateRandomQuestionsByDifficulty($subject, 20, 15, 10);
                }
            break;
            case '60':
                if($exam_type == config('app.exam_type.Mid-term'))
                {
                    $this->generateRandomQuestionsByDifficulty($subject, 30, 20, 10);
                }
                if($exam_type == config('app.exam_type.Final'))
                {
                    $this->generateRandomQuestionsByDifficulty($subject, 30, 15, 15);
                }
            break;
            case '90':
                if($exam_type == config('app.exam_type.Mid-term'))
                {
                    $this->generateRandomQuestionsByDifficulty($subject, 45, 30, 15);
                }
                if($exam_type == config('app.exam_type.Final'))
                {
                    $this->generateRandomQuestionsByDifficulty($subject, 45, 25, 20);
                }
            break;
        }
    }

    /**
     * @return [type]
     */
    protected function generateRandomQuestionsByDifficulty($subject, $number_of_normal_questions, $number_of_medium_questions, $number_of_hard_questions)
    {
      $question = [];
      /**
       * -> Random a number of questions for each type add the questions to $question array, encode the array to json_string and save to database
      */
      $question[] = $this->questionRepository->addQuestionsToExamByDifficultyAndNumberOfQuestionsRequired($subject, config('app.question_level_of_difficult.normal'), $number_of_normal_questions);
      $question[] = $this->questionRepository->addQuestionsToExamByDifficultyAndNumberOfQuestionsRequired($subject, config('app.question_level_of_difficult.medium'), $number_of_medium_questions);
      $question[] = $this->questionRepository->addQuestionsToExamByDifficultyAndNumberOfQuestionsRequired($subject, config('app.question_level_of_difficult.hard'), $number_of_hard_questions);
      return json_encode($question);
    }

    /*
     * @param string $examID * @param string $class * @param string $question
     * @param string $numberOfSets * @param string $subject
     */
    //OPTIMIZE: Optimze this function,
    //TODO: Remove try-catch function without breaking workflow, the exam creation is not break even when there is
    function createQuestionSetFromExamQuestions($examID, $class, $question, $numberOfSets, $subject)
    {
        try {
            $studentInClass = $this->studentRepository->getAllStudentByClass($class);
            $studentInSet = [];
            foreach($studentInClass as $student)
            {
            $studentInSet[] = $student->id;
            }
            $studentID = ['1' => '', '2' => '', '3' => '', '4' => '']; //Generate 4 empty studentID instance for inserting, if there is no instance avaiable, studentID set to ''
            for($index = 1; $index <= 4; $index++)
            {
            if(count($studentInSet) > 2) //TODO: currently, there are 2-student-only hard coded into this function, this should be update in future release
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
            /** */
            $question_set = [];
            for($i = 1; $i <= $numberOfSets; $i++)
            {
            $setID = $examID.$i;

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
        }
    }

    protected function getExamStudent($examID)
    {
        $student_in_this_exam = $this->examRepository->getStudentsInExam($examID);
        $student_in_this_exam = json_decode($student_in_this_exam);
        return $student_in_this_exam;
    }

    /**
     * @param string $examID
     * @param array $studentIDs
     *
     * Add student to exam
     */
    protected function addStudentToExam($examID, $student_list, $examQuestionSets)
    {
      try {
        foreach($student_list as $student)
        {
            $student_question_set_id  = $this->assignStudentToQuestionSet($examQuestionSets);
            $this->studentExamRepository->addStudentToStudentExam($student->id, $examID, $student_question_set_id);
        }

      } catch (\Exception $e) {
          Log::error($e);
      }
    }

    protected function assignStudentToQuestionSet($examQuestionSets)
    {
        try {
            $question_set_id = "";
            $question_set_key = array_rand($examQuestionSets, 1);
            $question_set_id = $examQuestionSets[$question_set_key]['id'];
            return $question_set_id;
        } catch (\Exception $e) {
            Log::error($e);
        }

    }

    /**
     * @param string $ExamID
     * Compare the expired and current timestamp to
     * decide whether the exam has completed or not
     * @return $this->exam->status
     */
    //TODO: there is no function to decide if the exam is on-going
    public function getExamStatus($ExamID)
    {
      try
      {
        $exam = DB::table('exams')->select('start_at', 'duration')->where('id', $ExamID)->first();
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

    /**
     * @param mixed $id
     *
     * @return $this->exam's status
     */
    //TODO: Refractor this function, move query to repository classes
    //TODO: trace this function flow, this could be an ambious function, the is a possibility this function is unused in deploy
    public function checkExamStartTime($examID)
    {
      try
      {
        $exam = DB::table('exams')->select('start_at')->where('id', $examID)->first();
        if( (strtotime(Carbon::now()) - strtotime(Carbon::parse($exam->start_at))) > 1)
        {
            return true;
        }
      }catch(\Exception $e)
      {
          Log::error($e);
          return false;
      }
    }

    /**
     * @param mixed $examID
     * @param mixed $studentID
     *
     * @return [type]
     */
    public function getStudentExamQuestions($examID, $studentID)
    {
      try {
        $question_set_id = $this->studentExamRepository
                                    ->getStudentQuestionSet($examID, $studentID);
        $question_set_id = $question_set_id->question_set_id;
        $questions = $this->questionSetRepository
                                ->getQuestionsBySetId($question_set_id);
        $questions = json_decode($questions);
        $questions = $questions[0]->questions;
        $questions = json_decode($questions);
        $question_in_exam = [];
        //TODO: optimize this foreach, any query should be in repository classes
        foreach($questions as $question)
        {
          $questionID = $question->id;
          $question_in_exam[] = [
            'id' => $this->questionRepository
                        ->getQuestionsAndAnswers($questionID)
                        ->first()
                        ->id,
            'question' =>  $this->questionRepository
                                ->getQuestionsAndAnswers($questionID)
                                ->first()
                                ->question,
            'answers' => json_decode($this->questionRepository
                        ->getQuestionsAndAnswers($questionID)
                        ->first()
                        ->answer)
            ];
          }
          return $question_in_exam;
      } catch (\Exception $e) {
        Log::error($e);
        return null;
      }
    }
    /**
     * @param object $request
     * @param string $studentID
     * @param string $examID
     *
     * @return [type]
     */
    public function SaveStudentAnswer($request, $studentID, $examID)
    {
      $requests = $request->except('_token');
      $answers = [];
      $qId=''; $aId ='';
      for($i = 1; $i <= count($requests, 1) / 2; $i++)
      {
          foreach($requests as $index=>$request)
          {
            if((substr($index, -1) == $i) and (strpos($index, 'question') !== false))
            {
                $qId = $request;
            }
            if((substr($index, -1) == $i) and (strpos($index, 'answer') !== false))
            {
                $aId = $request;
            }
          }
          $answers[$i] = [
            'question_id' => $qId,
            'answer' => $aId,
          ];
      }
      $answers = json_encode($answers);
      if($this->studentExamRepository->updateStudentAnswer($studentID, $examID, $answers))
      {
        return true;
      }
      return false;
    }

    /**
     * @param string $studentID
     * @param string $examID
     *
     * -> Calculate student's score and update student_exam's status
     *
     * @return [
     *     'exam's score',
     *     'number_of_correct_answers',
     *     'number_of_wrong_answers'
     * ]
     */
    public function scoreCalculate($studentID, $examID)
    {
      $score = 0;
      $correct_answers = 0;
      $answers = $this->studentExamRepository->getStudentExamAnswers($studentID, $examID); //Receiving the encoded answers string from DB
      $answers = json_decode($answers->student_answers); //Decode the answers string to PHP object and re-asign it to $answers
      $total = count((array)$answers);
      /**
       * Traverse through answers array
       * Check if the answer is correct
       * If true, add score based on answer's type
       */
      //OPTIMIZE: update add score logic, define the amount of score to add by question type
      foreach($answers as $index=>$answer)
      {
        if($this->is_correct($answer->answer, $answer->question_id))
        {
          $score+=15;
          $correct_answers++;
        }
      }
      $this->studentExamRepository
            ->updateStudentScore($studentID, $examID, $score);
      $status = 2;
      $this->studentExamRepository
            ->updateStudentExamStatus($studentID, $examID, $status);
      $result = [
        'score' => $score,
        'correct_answers' => $correct_answers,
        'wrong_answers' => $total - $correct_answers,
      ];
      return $result;
    }

    /**
     * @param tinyInt $answer
     * @param string $questionID
     *
     * @return True if the answers == DB('answers.is_correct') or else False
     */
    function is_correct($answer, $questionID)
    {
      $correct_answer = $this->questionRepository->getQuestionCorrectAnswer($questionID);
      $correct_answer = $correct_answer->is_correct;
      return $answer == $correct_answer;
    }

    /**
     * @param string $examID
     *
     * This function delete all exam's related data,
     * which mean it will cause an error if you trying to
     * delete data from related table when the exam failed to
     * created
     *
     * @return delete exam status
     */
    public function deleteExamDataByID($examID)
    {
        try {
            /** Delete exam questiosn */
            $this->examQuestionRepository->deleteExamQuestionByExamID($examID);
            /** Delete exam question sets */
            $this->questionSetRepository->deleteQuestionSetsByExamID($examID);
            /** Delete student's exam */
            $this->studentExamRepository->deleteStudentExamByExamID($examID);
            /** Delete the exam itself */
            $this->examRepository->deleteExamByID($examID);
            return true;
        } catch (\Exception $e) {
            return false;
            Log::error($e);
        }
    }

    public function ajaxSearchForStudent($request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('users')
                ->where('role', '1')
                ->where('name', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul style="display:block; position:relative">';
            foreach ($data as $row) {
                $output .= '
               <li><span style="color: black;" href="data/' . $row->id . '">' .'Name: ' .$row->name .' ID: '.$row->id. '</span></li>
               ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
