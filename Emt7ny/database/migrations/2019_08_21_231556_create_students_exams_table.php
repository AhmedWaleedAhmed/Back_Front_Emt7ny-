<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students_exams', function (Blueprint $table) {
            $table->unsignedBigInteger('studentId');
            $table->foreign('studentId')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('examId');
			$table->foreign('examId')->references('id')->on('exams')->onDelete('cascade');
			$table->primary(['studentId', 'examId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students_exams');
    }
}
