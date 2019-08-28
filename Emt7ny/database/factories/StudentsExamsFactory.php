<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\exam;
use App\User;
use App\students_exam;

$factory->define(students_exam::class, function (Faker $faker) {
    $examId = exam::all()->pluck('id');
    if ($examId->isEmpty()) {
        $examId = factory(exam::class, 3)->create()->pluck('id');
    }
    $examId = $examId->random();
    $studentId = User::query()->where('isTeacher', 0)->pluck('id');
    if ($studentId->isEmpty()) {
        $studentId = factory(User::class, 3)->state('student')->create()->pluck('id');
    }
    $studentId = $studentId->random();
    if (students_exam::query()->where(compact('studentId', 'examId'))) {
        $examId = factory(exam::class)->create()->id;
    }
    return compact('studentId', 'examId');
});
