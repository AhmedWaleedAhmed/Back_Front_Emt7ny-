<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_teachers', function (Blueprint $table) {
            $table->unsignedBigInteger('examId');
			$table->foreign('examId')->references('id')->on('exams')->onDelete('cascade');
			$table->unsignedBigInteger('teacherId');
			$table->foreign('teacherId')->references('id')->on('users')->onDelete('cascade');
            $table->primary(['examId', 'teacherId']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams_teachers');
    }
}
