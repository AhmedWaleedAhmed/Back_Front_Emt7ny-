<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\exam;
use App\question;

$factory->define(question::class, function (Faker $faker) {
    $examIDs = exam::all()->pluck('id');
    if ($examIDs->isEmpty()) {
        $examIDs = factory(exam::class, 3)->create()->pluck('id');
    }
    return [
        'question' => $faker->text,
        'examId' => $examIDs->random()
    ];
});
