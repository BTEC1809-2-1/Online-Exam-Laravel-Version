<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->string('id', 255);
            $table->string('subject');
            $table->string('semester');
            $table->string('classroom');
            $table->string('lecture');
            $table->dateTime('start_at',0);
            $table->time('duration');
            $table->string('status');
            $table->timestamp('created_at',0);
            $table->string('created_by');
            $table->timestamp('updated_at',0);
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
        Schema::dropIfExists('exams');
    }
}
