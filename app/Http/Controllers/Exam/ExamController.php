<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Services\Exam\ExamService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\examRequest;
use Illuminate\Http\Request;

//TODO: change description
/*
|--------------------------------------------------------------------------
| Login Controller
|--------------------------------------------------------------------------
|
| This controller handles authenticating users for the application and
| redirecting them to your home screen. The controller uses a trait
| to conveniently provide its functionality to your applications.
|
*/

class ExamController extends Controller
{
    protected $examService;

    /**
     * @param ExamService $examService
     */
    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }

    /**
     * @param mixed $examID
     *
     * @return [type]
     */
    public function getExamDetail($examID)
    {

        $exam = $this->examService->getExamDetail($examID);

        $exam_questions = json_decode($exam->questions_in_exam);
        $students_in_exam = json_decode($exam->students_in_exam);

        return view('Admin.pages.exam_detail',
                    compact (
                        'exam',
                        'exam_questions',
                        'students_in_exam'));
    }

    public function getExamQuestionSet($examID)
    {
        $exam_question_sets = $this->examService->getQuestionSets($examID);

        $number_of_sets_created = count($exam_question_sets);

        $number_of_questions_per_set = count(json_decode($exam_question_sets
                                        ->first()
                                        ->questions));
        $normal = 0; $medium = 0; $hard = 0;

        foreach(json_decode($exam_question_sets->first()->questions) as $question)
        {
            if ( $question->level_of_difficult
                 ==
                 config('app.question_level_of_difficult.normal')
            ) {
                $normal++;
            }

            if ( $question->level_of_difficult
                 ==
                 config('app.question_level_of_difficult.medium')
            ) {
                $medium++;
            }

            if ( $question->level_of_difficult
                 ==
                 config('app.question_level_of_difficult.hard')
            ) {
                $hard++;
            }
        }

        return view('Admin.pages.exam_question_sets',
                    compact (
                        'number_of_sets_created',
                        'number_of_questions_per_set',
                        'exam_question_sets',
                        'normal', 'medium', 'hard'));
    }

    /**
     * @return [type]
     */
    public function getUpcomingExam()
    {
        $exam = $this->examService->getUpcomingExam();

        return view('Admin.pages.exam_detail', compact('exam'));
    }

    /**
     * @return [type]
     */
    public function getExamList()
    {
        $listExam = DB::table('exams')
                        ->orderBy('created_at', 'desc')
                        ->paginate(6);

        return view('Admin.pages.exam_list', compact('listExam'));
    }

    /**
     * @return [type]
     */
    public function create()
    {
        return view('Admin.pages.create_exam');
    }

    /**
     * @param examRequest $request
     *
     * @return [type]
     */
    public function store(Request $request)
    {
        $examID = 'EXAM'.$request->subject.$request->semester.date('YmdHis');

        if ($this->examService->createNewExam($request, $examID)) {
            return redirect()->route('get.exam.list')

                             ->with (
                                 'success',
                                 'You has successfully created the exam')
                             ->with (
                                 'exam_id',
                                 $examID);
        }

        return redirect()->route('get.exam.list')
                         ->with (
                             'error',
                             'Cannot create Exam (No Questions avaiable),
                              please report to the administrator to fix this problem');

    }

    /**
     * @param string $examID
     *
     * @return view('Admin.pages.exam_list) with message
     */
    public function delete($examID)
    {
        if ($this->examService->deleteExamDataByID($examID)) {
            return redirect()->route('get.exam.list')
                             ->with (
                                 'success',
                                 'You has successfully deleted the exam');
        }

        return redirect()->route('get.exam.list')
                         ->with (
                             'error',
                             'Some errors had occured, you has not delete the exam,
                              please contact the administrator to fix this problem');
    }

    public function searchStudent(Request $request)
    {
        return $this->examService->ajaxSearchForStudent($request);
    }

    public function removeStudentFromExam($examID, $studentID)
    {
        if($this->examService->removeStudentFromExam($examID, $studentID))
        {

            return view('Admin.pages.exam_detail', ['id' => $examID])
                    ->with (
                        'sucess',
                        'You have remove student '.$studentID.' from this exam!');
        }

        return view('Admin.pages.exam_detail', ['id' => $examID])
                    ->with (
                        'error',
                        'Error, not thing has changed');
    }

    public function update(Request $request, $examID)
    {
        if($this->examService->update($request, $examID))
        {
            return redirect()->route('get.exam.detail', ['id' => $examID])
                    ->with('sucess', 'The exam has been updated');
        }

        return redirect()->route('get.exam.detail',['id' => $examID])
                    ->with('error', 'Error, not thing has changed');
    }

}
