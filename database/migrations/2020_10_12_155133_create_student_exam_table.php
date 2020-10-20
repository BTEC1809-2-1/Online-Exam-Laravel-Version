<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_exams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_id', 255);
            $table->string('exam_id', 255);
            $table->string('question_set_id', 255);
            $table->string('student_answers_id', 255)->nullable();
            $table->string('point')->nullable();
            $table->timestamp('created_at');
            $table->string('created_by');
            $table->timestamp('updated_at');
            $table->string('updated_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_exam');
    }
}
