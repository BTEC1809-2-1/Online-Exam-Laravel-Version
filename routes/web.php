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

Auth::routes();

Route::get('/', 'AdminController@index')->name('dashboard');

Route::get('logout', function(){Auth::logout(); return redirect('/');});

Route::get('/Question/Create', 'Question\QuestionController@create')->name('create.question');
Route::post('/Question/Store', 'Question\QuestionController@store')->name('question.store');
Route::get('/Question/Delete/{id}', 'Question\QuestionController@delete')->name('question.delete');
Route::get('/Question/Detail/{id}', 'Question\QuestionController@getQuestionDetail')->name('get.question.detail');
Route::get('/Question/List', 'Question\QuestionController@getQuestionList')->name('get.question.list');
Route::get('/Question/{id}/Answer', 'Question\QuestionController@addAnswer')->name('question.add.answer');
Route::post('/Question/{qid}/Answer/Store', 'Question\QuestionController@storeAnswer')->name('question.answer.store');
Route::get('/Question/Update/{id}','Question\QuestionController@getQuestionList')->name('question.update');

Route::get('/Exam/Create', 'Exam\ExamController@create')->name('create.exam');
Route::post('/Exam/Store', 'Exam\ExamController@store')->name('exam.store');
Route::get('/Exam/Detail/{id}', 'Exam\ExamController@getExamDetail')->name('get.exam.detail');
Route::get('/Exam/List', 'Exam\ExamController@getExamList')->name('get.exam.list');

Route::post('search/name', 'SearchController@getSearchAjax')->name('search');

