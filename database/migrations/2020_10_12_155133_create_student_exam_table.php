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
            $table->string('id');
            $table->string('student_id');
            $table->string('exam_id');
            $table->string('question_set_id');
            $table->string('student_answers_id');
            $table->string('point')->nullable();
            $table->timestamp('created_at');
            $table->string('created_by');
            $table->timestamp('updated_at');
            $table->string('updated_by');
            $table->primary('id');
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
