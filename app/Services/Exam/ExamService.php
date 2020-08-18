<?php
namespace App\Services\Exam;

use App\Repositories\ExamRepository;
use App\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ExamService {
  protected $examRepository;

  public function __construct(ExamRepository $examRepository){

    $this->examRepository = $examRepository;

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

  public function storageExam(Request $request){

    $exam = new Exam;

    $exam->id = $request->input('id');
    $exam->semester = $request->input('semester');
    $exam->classroom = $request->input('classroom');
    $exam->start_at = $request->input('start_at');
    $exam->status = $request->input('status');
    $exam->duration = $request->input('duration');
    $exam->created_by = Auth::user()->name;

    $exam->save();

  }

}
