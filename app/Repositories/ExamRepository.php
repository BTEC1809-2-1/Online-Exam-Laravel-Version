<?php

namespace App\Repositories;

use App\Exam;
use Illuminate\Support\Facades\DB;

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
        $listExam = DB::table('exams')->paginate(6);
        return $listExam;
    }

    public function getUpcomingExam(){
        $listExam = DB::table('exams')->limit(3)->get();
        return $listExam;
    }

    public function getExam($id)
    {
        $query = $this->query()->addSelect('duration', 'created_at', 'created_by', 'updated_at', 'updated_by');
        return $query->findOrFail($id);
    }
}
