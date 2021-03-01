<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dentistas;
use Faker\Generator as Faker;

$factory->define(Dentistas::class, function (Faker $faker) {
    return [
        
        'nome'=>$faker->name
    ];
});
