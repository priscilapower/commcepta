<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ProductSale;
use Faker\Generator as Faker;

$factory->define(ProductSale::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween(1,30),
        'sale_id' => $faker->numberBetween(1,200),
    ];
});
