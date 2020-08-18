<?php

use GuzzleHttp\Middleware;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['web']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/Question/Create', 'Question\QuestionController@create')->name('create.question');
    Route::get('/Question/Detail/{id}', 'Question\QuestionController@getQuestionDetail')->name('get.question.detail');
    Route::get('/Question/List', 'Question\QuestionController@getQuestionList')->name('get.question.list');

    Route::get('/Exam/Create', 'Exam\ExamController@create')->name('create.exam');
    Route::get('/Exam/Detail/{id}', 'Exam\ExamController@getExamDetail')->name('get.exam.detail');
    Route::get('/Exam/List','Exam\ExamController@getExamList')->name('get.exam.list');

});

