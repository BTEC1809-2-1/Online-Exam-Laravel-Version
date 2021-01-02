<?php

namespace App\Repositories;

use App\Exam;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ExamRepository extends BaseRepository {
    public function model()
    {
        return Exam::class;
    }

    public function query()
    {
        $query = $this->model->select(
            'id',
            'semester',
            'classroom',
            'start_at',
            'status'
        );

        return $query;
    }

    public function getAllExam()
    {
        $listExam = Exam::paginate(8);

        return $listExam;
    }

    public function createExam (
        $request,
        $examID,
        $questions_in_exam,
        $students_in_exam
    ) {
        $exam = new Exam();
        $exam->id = $examID;
        $exam->semester = $request->semester;
        $exam->duration = $request->duration;
        $exam->start_at = date($request->date.' '.$request->time);
        $exam->lecture = $request->lecture;
        $exam->classroom = $request->classroom;
        $exam->subject = $request->subject;
        $exam->exam_type = $request->exam_type;
        $exam->questions_in_exam = $questions_in_exam;
        $exam->students_in_exam = $students_in_exam;
        $exam->status = config('app.exam_status.Ready');
        $exam->created_by = Auth::user()->id;
        $exam->updated_by = Auth::user()->id;
        $exam->save();
    }

    public function deleteExamById($examID)
    {
        return Exam::where('id', $examID)->delete();
    }

    public function getUpcomingExam()
    {
        $listExam = DB::table('exams')
            ->limit(3)
            ->orderBy('start_at', 'DESC')
            ->get();

        return $listExam;
    }

    public function countUpcomingExam()
    {
        return $this->model
                    ->where('status', config('app.exam_status.Ready'))
                    ->count();
    }

    public function countOnGoingExam()
    {
        return $this->model
                    ->where('status', config('app.exam_status.On-going'))
                    ->count();
    }

    public function countCompletedExam()
    {
        return $this->model
                    ->where('status', config('app.exam_status.Ended'))
                    ->count();
    }

    public function getExam($id)
    {
        $query = $this->query()->addSelect (
            'duration',
            'students_in_exam',
            'lecture',
            'questions_in_exam',
            'created_at',
            'created_by',
            'updated_at',
            'updated_by');

        return $query->findOrFail($id);
    }

    public function getStudentsInExam($examID)
    {
        $exam = DB::table('exams')->where('id', $examID);

        if($exam->exists())
        {
            return $exam->select('student_in_exam')->get();
        }

        return null;
    }

    public function updateExamStudentList($examID, $student_list)
    {
        return Exam::where('id', $examID)
                    ->update(['student_in_exam' => $student_list]);
    }

    public function updateExam($request, $examID)
    {
        return Exam::where('id', $examID)->update([
            'lecture' => $request->lecture,
            'start_at' => date($request->date.' '.$request->startTime),
            'status' => $request->status,
        ]);
    }
}
