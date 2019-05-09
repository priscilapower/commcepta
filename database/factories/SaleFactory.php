<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Sale;
use Faker\Generator as Faker;

$factory->define(Sale::class, function (Faker $faker) {
    return [
        'id_seller' => $faker->numberBetween(1,10),
        'created_at' => $faker->dateTimeBetween('-2 years')
    ];
});
