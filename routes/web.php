<?php

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
 * -------------------------------------------------
 * Un-authenticated route
 * -------------------------------------------------
 *
 * These route will handle un-authenticated user request
 *
 */

Auth::routes(['login' => true,'register' => false]);
Route::auth();
//Route for socialite login
Route::get('/auth/redirect/{provider}', 'SocialController@redirect')->name('login.google');
Route::get('/auth/callback/{provider}', 'SocialController@callback');

// Route for basic login
Route::get('/', fn() => view('welcome'));
Route::get('logout','Auth\LoginController@logout');


/**
 * -------------------------------------------------
 * Authenticated route
 * -------------------------------------------------
 *
 * Only authenticated user can access these routes,
 * otherwise, they must login
 *
 */
Route::group(['middleware' => ['auth']], function () {
    /** Route for admin role */
    Route::group(['middleware' => 'admin'], function ()
    {
        /** Route to admin dashboard */
        Route::get('/admin', 'AdminController@index')->name('admin');
        /** Question route group */
        Route::get('/Question/Create', 'Question\QuestionController@create')->name('create.question');
        Route::post('/Question/Create', 'Question\QuestionController@store')->name('question.store');
        Route::get('/Question/Detail/{id}', 'Question\QuestionController@getQuestionDetail')->name('get.question.detail');
        Route::get('/Question/Delete/{id}', 'Question\QuestionController@delete')->name('question.delete');
        Route::post('/Question/Detail/{id}','Question\QuestionController@updateQuestionDetail')->name('question.update');
        Route::get('/Question/List', 'Question\QuestionController@getQuestionList')->name('get.question.list');
        Route::post('/Questions','Question\AjaxSearchController@index');
        /** Exam route group */
        Route::get('/Exam/Create', 'Exam\ExamController@create')->name('create.exam');
        Route::post('/Exam/Create', 'Exam\ExamController@store')->name('exam.store');
        Route::post('/findStudent', 'Exam\ExamController@searchStudent')->name('student.search');
        /** */
        Route::get('/Exam/Detail/{id}', 'Exam\ExamController@getExamDetail')->name('get.exam.detail');
        Route::post('/Exam/Detail/{id}', 'Exam\ExamController@update')->name('update.exam.detail');
        Route::get('/Exam/{id}/QuestionSets', 'Exam\ExamController@getExamQuestionSet')->name('get.Exam.QuestionSets');
        Route::get('/Exam/Detail/{id}/Remove', 'Exam\ExamController@delete')->name('exam.delete');
        Route::get('/Exam/Detail/{examID}RemoveStudent/{studentID}', 'Exam\ExamController@removeStudentFromExam')->name('exam.remove.student');
        /**TODO: create this function*/
        Route::get('/Exam/Detail/{id}/remove/{question}', 'Exam\ExamController@deleteQuestion')->name('exam.question.remove');
        Route::get('/Exam/List', 'Exam\ExamController@getExamList')->name('get.exam.list');
    });

    /** Route for student role */
    Route::get('/student', 'Student\StudentController@showReadyPage')->name('student');
    Route::get('/Do-Exam/{id}', 'Student\StudentController@showDoExamPage')->name('do.exam.page');
    Route::post('/Do-Exam','Student\StudentController@submitExam')->name('submit.exam');

});




