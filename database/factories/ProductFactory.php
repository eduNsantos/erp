<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'code' => "S".$faker->numberBetween(0, 999),
        'name' => $faker->name,
        'description' => $faker->name,
        'multiple' => $faker->numberBetween(0, 99),
        'unit_id' => $faker->numberBetween(1,3),
        'brand_id' => 1,
        'product_category_id' => $faker->numberBetween(1,2),
        'product_group_id' => $faker->numberBetween(1,2),
        'product_status_id' => $faker->numberBetween(1,5)
    ];
});
