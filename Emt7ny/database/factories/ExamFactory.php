<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\exam;
use Illuminate\Support\Str;
use App\User;

$factory->define(exam::class, function (Faker $faker) {
    return [
        "title" => $faker->sentence(3),
        "instructions" => $faker->text
    ];
});
