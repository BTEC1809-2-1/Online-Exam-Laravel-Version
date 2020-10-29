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

/**
 * Un-authenticated route
 */

Auth::routes(['register' => false]);
//Route for socialite login
Route::get('/auth/redirect/{provider}', 'SocialController@redirect')->name('login.google');
Route::get('/callback/{provider}', 'SocialController@callback');
//TODO: move those function to a controller
Route::get('/', function()
    {
        if(Auth::check())
        {
            if(Auth::user()->role == config('app.role.admin'))
            {
                return redirect()->route('admin');
            }
            return redirect()->route('student');
        }
        return redirect()->route('login');
    }
);

Route::get('logout', function()
    {
        Auth::logout();
        return redirect('/');
    }
);

/**
 * Route for admin role
 */
Route::group(['middleware' => 'admin'], function () {
    Route::get('/admin', 'AdminController@index')->name('admin');
    //Question route group
    Route::get('/Question/Create', 'Question\QuestionController@create')->name('create.question');
    Route::post('/Question/Create', 'Question\QuestionController@store')->name('question.store');
    Route::get('/Question/Delete/{id}', 'Question\QuestionController@delete')->name('question.delete');
    Route::get('/Question/Detail/{id}', 'Question\QuestionController@getQuestionDetail')->name('get.question.detail');
    Route::get('/Question/List', 'Question\QuestionController@getQuestionList')->name('get.question.list');
    Route::get('/Question/{id}/Answer', 'Question\QuestionController@addAnswer')->name('question.add.answer');
    Route::post('/Question/{qid}/Answer/Store', 'Question\QuestionController@storeAnswer')->name('question.answer.store');
    Route::get('/Question/Update/{id}','Question\QuestionController@getQuestionList')->name('question.update');
    //Exam route group
    Route::get('/Exam/Create', 'Exam\ExamController@create')->name('create.exam');
    Route::post('/Exam/Create', 'Exam\ExamController@store')->name('exam.store');
    Route::get('/Exam/Detail/{id}', 'Exam\ExamController@getExamDetail')->name('get.exam.detail');
    Route::get('/Exam/Detail/{id}/remove/{question}', 'Exam\ExamController@getExamDetail')->name('exam.question.remove');
    Route::get('/Exam/List', 'Exam\ExamController@getExamList')->name('get.exam.list');
});
/**
 * Route for student rol
 */
Route::get('/student', 'Student\StudentController@showReadyPage')->name('student');
Route::get('/Do-Exam/{id}', 'Student\StudentController@showDoExamPage')->name('do.exam.page');
Route::post('/Do-Exam','Student\StudentController@submitExam')->name('submit.exam');
//NOTE: this is a test route, it should be remove when deploy Route::get('Result', 'Student\StudentController@testResultView')->name('exam.resutl');




