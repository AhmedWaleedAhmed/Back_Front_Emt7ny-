<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\choice_question;
use App\question;

$factory->define(choice_question::class, function (Faker $faker) {
    $questionIDs = question::all()->pluck('id');
    if ($questionIDs->isEmpty()) {
        $questionIDs = factory(question::class, 3)->create()->pluck('id');
    }
    return [
        'choice' => $faker->sentence,
        'questionId' => $questionIDs->random()
    ];
});
