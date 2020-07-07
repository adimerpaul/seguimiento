<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Seguimiento;
use Faker\Generator as Faker;

$factory->define(Seguimiento::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->firstName().' '.$faker->lastName,
        'numero'=>$faker->numberBetween($min = 10000, $max = 90000)
    ];
});
