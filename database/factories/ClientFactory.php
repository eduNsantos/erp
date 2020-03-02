<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'person_type' => $faker->numberBetween(0, 1) == 1 ? "CPF" : "CNPJ",
        'register_number' => $faker->numberBetween(111111111111111, 999999999999999),
        'corporate_name' => $faker->text(20),
        'fantasy_name' => $faker->text(20),
    ];
});
