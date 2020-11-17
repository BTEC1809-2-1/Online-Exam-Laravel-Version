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
    public function createNewExam($request, $examID)
    {
      try
      {
         //Generate the exam's ID based on the subject, semester and current dateTime. All exam start with "EXAM" keyword, format: EXAM<subject><semester><dateTime>
        $questions_in_exam = $this->createExamQuestions($request->subject, $request->question_per_set, $request->exam_type);
        $student_in_request_class = $this->getListOfStudentInClass($request->classroom);
        $custom_added_student = [];
        $students_in_exam = array_merge($student_in_request_class, $custom_added_student);
        $this->examRepository->createExam($request, $examID, json_encode($questions_in_exam), json_encode($students_in_exam));
        $this->createExamQuestionSets($examID, $questions_in_exam, $request->duration, $request->number_of_set, $request->question_per_set, $request->exam_type, $request->subject);
        $this->addStudentToExam($examID, $students_in_exam);
        return true;
      }catch(\Exception $e)
      {
        Log::error($e);
        $this->examRepository->deleteExamByID($examID);
        return false;
      }
    }

    protected function getListOfStudentInClass($class)
    {
        $studentList = $this->studentRepository->getAllStudentByClass($class);
        $student_in_class_id = [];
        foreach($studentList as $student)
        {
            array_push($student_in_class_id, ($student->id));
        }
        return $student_in_class_id;
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
               return $this->generateRandomQuestionsByDifficulty($subject, 10, 6, 0);
            break;
            case '12':
                return $this->generateRandomQuestionsByDifficulty($subject, 10, 8, 4);
            break;
            case '15':
                return $this->generateRandomQuestionsByDifficulty($subject, 12, 6, 6);
            break;
            case '30':
                if($exam_type == config('app.exam_type.Normal'))
                {
                    return $this->generateRandomQuestionsByDifficulty($subject, 20, 15, 10);
                }
                if($exam_type == config('app.exam_type.Mid-term'))
                {
                    return $this->generateRandomQuestionsByDifficulty($subject, 20, 15, 10);
                }
                if($exam_type == config('app.exam_type.Final'))
                {
                    return $this->generateRandomQuestionsByDifficulty($subject, 20, 15, 10);
                }
            break;
            case '45':
                if($exam_type == config('app.exam_type.Normal'))
                {
                    return $this->generateRandomQuestionsByDifficulty($subject, 30, 25, 15);
                }
                if($exam_type == config('app.exam_type.Mid-term'))
                {
                    return $this->generateRandomQuestionsByDifficulty($subject, 30, 25, 15);
                }
                if($exam_type == config('app.exam_type.Final'))
                {
                    return $this->generateRandomQuestionsByDifficulty($subject, 30, 25, 15);
                }
            break;
            case '60':
                if($exam_type == config('app.exam_type.Mid-term'))
                {
                    return $this->generateRandomQuestionsByDifficulty($subject, 40, 25, 20);
                }
                if($exam_type == config('app.exam_type.Final'))
                {
                    return $this->generateRandomQuestionsByDifficulty($subject, 40, 20, 20);
                }
            break;
            case '90':
                if($exam_type == config('app.exam_type.Mid-term'))
                {
                    return $this->generateRandomQuestionsByDifficulty($subject, 60, 40, 25);
                }
                if($exam_type == config('app.exam_type.Final'))
                {
                    return $this->generateRandomQuestionsByDifficulty($subject, 60, 40, 25);
                }
            break;
        }
    }

    /**
     * @return [type]
     */
    protected function generateRandomQuestionsByDifficulty($subject, $number_of_normal_questions, $number_of_medium_questions, $number_of_hard_questions)
    {
      $questions = [];
      $questions = array_merge($questions, $this->questionRepository->addQuestionsToExamByDifficultyAndNumberOfQuestionsRequired($subject, config('app.question_level_of_difficult.normal'), $number_of_normal_questions));
      $questions = array_merge($questions, $this->questionRepository->addQuestionsToExamByDifficultyAndNumberOfQuestionsRequired($subject, config('app.question_level_of_difficult.medium'), $number_of_medium_questions));
      $questions = array_merge($questions, $this->questionRepository->addQuestionsToExamByDifficultyAndNumberOfQuestionsRequired($subject, config('app.question_level_of_difficult.hard'), $number_of_hard_questions));
      return $questions;
    }

    /*
     * @param string $examID * @param string $class * @param string $question
     * @param string $numberOfSets * @param string $subject
     */
    function createExamQuestionSets($examID, $questions_in_exam, $duration, $number_of_set, $number_of_questions_per_set, $exam_type, $subject)
    {
        $questions = $questions_in_exam;
        try {
            switch($duration)
            {
                case "00:15:00":
                    if($number_of_questions_per_set == 10)
                    {
                        $this->createQuestionSetFromGivenQuestions($examID, $questions, $number_of_set, $subject, 7, 3, 0);
                    }
                    if($number_of_questions_per_set == 12)
                    {
                        $this->createQuestionSetFromGivenQuestions($examID, $questions, $number_of_set, $subject, 7, 4, 1);
                    }
                    if($number_of_questions_per_set == 15)
                    {
                        $this->createQuestionSetFromGivenQuestions($examID, $questions, $number_of_set, $subject, 9, 4, 2);
                    }
                break;
                case '00:45:00':
                    if($number_of_questions_per_set == 30)
                    {
                        if($exam_type == config('app.exam_type.Normal'))
                        {
                            $this->createQuestionSetFromGivenQuestions($examID, $questions, $number_of_set, $subject, 15, 10, 5);
                        }
                        if($exam_type == config('app.exam_type.Mid-term'))
                        {
                            $this->createQuestionSetFromGivenQuestions($examID, $questions, $number_of_set, $subject, 15, 9, 6);
                        }
                        if($exam_type == config('app.exam_type.Final'))
                        {
                            $this->createQuestionSetFromGivenQuestions($examID, $questions, $number_of_set, $subject, 15, 8, 7);
                        }
                    }
                    if($number_of_questions_per_set == 45)
                    {
                        if($exam_type == config('app.exam_type.Normal'))
                        {
                            $this->createQuestionSetFromGivenQuestions($examID, $questions, $number_of_set, $subject, 25, 15, 5);
                        }
                        if($exam_type == config('app.exam_type.Mid-term'))
                        {
                            $this->createQuestionSetFromGivenQuestions($examID, $questions, $number_of_set, $subject, 20, 15, 10);
                        }
                        if($exam_type == config('app.exam_type.Final'))
                        {
                            $this->createQuestionSetFromGivenQuestions($examID, $questions, $number_of_set, $subject, 20, 13, 12);
                        }
                    }
                break;
                case '01:30:00':
                    if($number_of_questions_per_set == 60)
                    {
                        if($exam_type == config('app.exam_type.Mid-term'))
                        {
                            $this->createQuestionSetFromGivenQuestions($examID, $questions, $number_of_set, $subject, 0, 0, 0);
                        }
                        if($exam_type == config('app.exam_type.Final'))
                        {
                            $this->createQuestionSetFromGivenQuestions($examID, $questions, $number_of_set, $subject, 0, 0, 0);
                        }
                    }
                    if($number_of_questions_per_set == 90)
                    {
                        if($exam_type == config('app.exam_type.Mid-term'))
                        {
                            $this->createQuestionSetFromGivenQuestions($examID, $questions, $number_of_set, $subject, 45, 30, 15);
                        }
                        if($exam_type == config('app.exam_type.Final'))
                        {
                            $this->createQuestionSetFromGivenQuestions($examID, $questions, $number_of_set, $subject, 45, 25, 20);
                        }
                    }
                break;
            }

        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    protected function createQuestionSetFromGivenQuestions($examID, $questions, $numberOfSets, $subject, $normal, $medium, $hard)
    {
        for($i = 0; $i < $numberOfSets; $i++)
        {
            $setID = $examID.$i;
            $question_in_set = [];
            $normalQuestions = []; $mediumQuestions = []; $hardQuestions = [];
            foreach($questions as $question)
            {
                if($question->level_of_difficult == config('app.question_level_of_difficult.normal'))
                {
                    array_push($normalQuestions, $question);
                }
                if($question->level_of_difficult == config('app.question_level_of_difficult.medium'))
                {
                    array_push($mediumQuestions, $question);
                }
                if($question->level_of_difficult == config('app.question_level_of_difficult.hard'))
                {
                    array_push($hardQuestions, $question);
                }

            }
            $normalQuestionsIndexes = array_rand($normalQuestions, $normal);
            $mediumQuestionsIndexes = array_rand($mediumQuestions, $medium);
            if($hard != 0)
            {
                $hardQuestionsIndexes = array_rand($hardQuestions, $hard);
            }
            try
            {
                foreach ($normalQuestionsIndexes as $n_index) {
                    array_push($question_in_set, $normalQuestions[$n_index]);
                }
                foreach ($mediumQuestionsIndexes as $m_index) {
                    array_push($question_in_set, $mediumQuestions[$m_index]);
                }
                foreach ($hardQuestionsIndexes as $h_index) {
                   array_push($question_in_set, $hardQuestions[$h_index]);
                }
            }catch(\Exception $e)
            {
                if($hard != 0)
                {
                    array_push($question_in_set, $hardQuestions[$hardQuestionsIndexes]);
                }
                Log::error($e);
            }
            $this->questionSetRepository->createQuestionSet($setID, json_encode($question_in_set), $subject);
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
     * Add student to exam
     */
    protected function addStudentToExam($examID, $student_list)
    {
        $setsID = $this->getExamQuestionSetsID($examID);
      try {
        foreach($student_list as $student)
        {
            $student_question_set_id  = $this->assignStudentToQuestionSet($setsID);
            $this->studentExamRepository->addStudentToStudentExam($student->id, $examID, $student_question_set_id);
        }

      } catch (\Exception $e) {
          Log::error($e);
      }
    }

    protected function getExamQuestionSetsID($examID)
    {
        $setsID = [];
        try
        {
            $examQuestionSets = $this->questionSetRepository->getQuestionSetByExam($examID);
            foreach($examQuestionSets as $set)
            {
                array_push($setID, $set->id);
            }
            return $setsID;
        }
        catch(\Exception $e)
        {
            Log::error($e);
            return $setsID;
        }
    }

    protected function assignStudentToQuestionSet($setsID)
    {
        try {
            $question_set_id = "";
            $question_set_key = array_rand($setsID, 1);
            $question_set_id = $$setsID[$question_set_key]['id'];
            return $question_set_id;
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    /**
     * @param string $ExamID
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
    public function checkExamStartTime($examID)
    {
        try
        {
            $exam = $this->examRepository->getExam($examID);
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
        $question_set_id = $this->studentExamRepository->getStudentQuestionSet($examID, $studentID);
        $question_set_id = $question_set_id->question_set_id;
        $questions = $this->questionSetRepository->getQuestionsBySetId($question_set_id);
        $questions = json_decode($questions);
        $questions = $questions[0]->questions;
        $questions = json_decode($questions);
        $question_in_exam = [];
        foreach($questions as $question)
        {
          $questionID = $question->id;
          $question_in_exam[] = [
            'id' => $this->questionRepository->getQuestionsAndAnswers($questionID)->first()->id,
            'question' =>  $this->questionRepository->getQuestionsAndAnswers($questionID)->first()->question,
            'answers' => json_decode($this->questionRepository->getQuestionsAndAnswers($questionID)->first()->answer)
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
     * @return delete exam status
     */
    public function deleteExamDataByID($examID)
    {
        try {
            $this->examQuestionRepository->deleteExamQuestionByExamID($examID);
            $this->questionSetRepository->deleteQuestionSetsByExamID($examID);
            $this->studentExamRepository->deleteStudentExamByExamID($examID);
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
            $data = DB::table('users')->where('role', '1')->where('name', 'LIKE', "%{$query}%")->get();
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
