<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['register' => false]);

Route::get('/auth/redirect/{provider}', 'SocialController@redirect')->name('login.google');
Route::get('/callback/{provider}', 'SocialController@callback');

Route::get('/', function(){
    if(Auth::check())
    {
        if(Auth::user()->role == config('app.role.admin'))
        {
            return redirect()->route('admin');
        }
        return redirect()->route('student');
    }
    return redirect()->route('login');
});
Route::get('logout', function(){Auth::logout(); return redirect('/');});


Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', 'AdminController@index')->name('admin');

    Route::get('/Question/Create', 'Question\QuestionController@create')->name('create.question');
    Route::post('/Question/Store', 'Question\QuestionController@store')->name('question.store');
    Route::get('/Question/Delete/{id}', 'Question\QuestionController@delete')->name('question.delete');
    Route::get('/Question/Detail/{id}', 'Question\QuestionController@getQuestionDetail')->name('get.question.detail');
    Route::get('/Question/List', 'Question\QuestionController@getQuestionList')->name('get.question.list');
    Route::get('/Question/{id}/Answer', 'Question\QuestionController@addAnswer')->name('question.add.answer');
    Route::post('/Question/{qid}/Answer/Store', 'Question\QuestionController@storeAnswer')->name('question.answer.store');
    Route::get('/Question/Update/{id}','Question\QuestionController@getQuestionList')->name('question.update');

    Route::get('/Exam/Create', 'Exam\ExamController@create')->name('create.exam');
    Route::post('/Exam/Create', 'Exam\ExamController@store')->name('exam.store');
    Route::get('/Exam/Detail/{id}', 'Exam\ExamController@getExamDetail')->name('get.exam.detail');
    Route::get('/Exam/List', 'Exam\ExamController@getExamList')->name('get.exam.list');
});

Route::get('/student', 'Student\StudentController@showReadyPage')->name('student');
Route::get('Do-Exam', 'Student\StudentController@showDoExamPage')->name('do.exam.page');
Route::post('Do-exam','Student\StudentController@submitExam')->name('submit.exam');





