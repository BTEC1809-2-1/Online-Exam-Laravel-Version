<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentExamConstrains extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->primary('id');
        });
        Schema::table('student_exams', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('users');
            $table->foreign('exam_id')->references('id')->on('exams');
            $table->foreign('student_answers_id')->references('id')->on('student_answers');
            $table->foreign('question_set_id')->references('id')->on('question_set');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_exam_constrains');
    }
}
