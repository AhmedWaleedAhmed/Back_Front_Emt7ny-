<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\answer;
use App\question;
use App\User;

$factory->define(answer::class, function (Faker $faker) {
    $questionId = question::all()->pluck('id');
    if ($questionId->isEmpty()) {
        $questionId = factory(question::class, 3)->create()->pluck('id');
    }
    $questionId = $questionId->random();
    $studentId = User::query()->where('isTeacher', 0)->pluck('id');
    if ($studentId->isEmpty()) {
        $studentId = factory(User::class, 3)->state('student')->create()->pluck('id');
    }
    $studentId = $studentId->random();
    if (answer::query()->where(compact('studentId', 'questionId'))) {
        $questionId = factory(question::class)->create()->id;
    }
    return [
        'answer' => $faker->text,
        'questionId' => $questionId,
        'studentId' => $studentId
    ];
});
