<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\picture_question;
use App\question;
use Illuminate\Support\Str;

$factory->define(picture_question::class, function (Faker $faker) {
    $questionIds = question::all()->pluck('id');
    return [
        'questionId' => $questionIds->random(),
        'image' => "public\\img\\" . Str::random(5) . ".jpg"
    ];
});
