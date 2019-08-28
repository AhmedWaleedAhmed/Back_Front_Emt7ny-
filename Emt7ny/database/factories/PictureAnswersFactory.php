<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\answer;
use App\picture_answer;

$factory->define(picture_answer::class, function (Faker $faker) {
    $answer = answer::all()->random();
    return [
        'image' => "public\\img\\" . Str::random(5) . ".jpg",
        'studentId' => $answer['studentId'],
        'questionId' => $answer['questionId']
    ];
});
