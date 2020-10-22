<?php

namespace App\Repositories;

use App\Exam;
use Illuminate\Http\Request;
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
        $listExam = DB::table('exams')
                    ->paginate(6);
        return $listExam;
    }

    public function createExam($request, $examID)
    {
        $exam = new Exam();
        $exam->id = $examID;
        $exam->semester = $request->semester;
        $exam->duration = $request->duration;
        $exam->start_at = date($request->date.' '.$request->startTime);
        $exam->classroom = $request->classroom;
        $exam->subject = $request->subject;
        $exam->status = 0;
        $exam->created_by = Auth::user()->id;
        $exam->updated_by = Auth::user()->id;
        $exam->save();
    }

    public function deleteExamById($id)
    {
        return Exam::where('id', $id)->delete();
    }

    public function getUpcomingExam()
    {
        $listExam = DB::table('exams')
            ->limit(3)
            ->orderBy('start_at', 'DESC')
            ->get();
        return $listExam;
    }

    public function getExam($id)
    {
        $query = $this->query()
            ->addSelect('duration', 'created_at', 'created_by', 'updated_at', 'updated_by');
        return $query->findOrFail($id);
    }

   
}
