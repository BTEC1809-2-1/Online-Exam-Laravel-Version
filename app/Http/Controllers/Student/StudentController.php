<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function showReadyPage()
    {
        return view('Student.pages.ready');
    }

    public function showDoExamPage()
    {
        return view('Student.pages.do-exam');
    }

    public function submitExam()
    {

    }

}
