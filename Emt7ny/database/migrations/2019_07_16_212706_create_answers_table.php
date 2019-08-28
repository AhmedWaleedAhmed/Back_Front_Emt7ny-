<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers', function (Blueprint $table) {
			$table->text('answer');
			$table->integer('mark')->nullable();
			$table->unsignedBigInteger('studentId');
			$table->foreign('studentId')->references('id')->on('users')->onDelete('cascade');
			$table->unsignedBigInteger('questionId');
			$table->foreign('questionId')->references('id')->on('questions')->onDelete('cascade');
			$table->primary(['studentId', 'questionId']);
			$table->unsignedBigInteger('correctorId')->nullable();
			$table->foreign('correctorId')->references('id')->on('users')->onDelete('set null');
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
		Schema::dropIfExists('answers');
	}
}
