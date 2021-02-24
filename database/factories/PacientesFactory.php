<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pacientes;
use Faker\Generator as Faker;

$factory->define(Pacientes::class, function (Faker $faker) {
    return [
        'ficha'=>$faker->randomNumber(),
        'nome'=>$faker->name,
        'data_nasc'=>$faker->dateTime(),
        'sexo'=>'M',
        'email'=>$faker->safeEmail,
        'imagem'=>'https://thispersondoesnotexist.com/image?'.$faker->randomNumber()
    ];
});
