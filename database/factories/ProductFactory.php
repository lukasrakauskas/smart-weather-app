<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $products = ["Sunglasses", "Hat", "Umbrella", "Sweater", "Coat", "Wellington boots"];
    $product = $faker->randomElement($products);
    $color = ucfirst($faker->safeColorName);

    return [
        'sku' => $color[0] . $product[0] . "-" .  $faker->unique()->numberBetween(100, 999),
        'name' => $color . " " . $product,
        'price' => $faker->randomFloat(2, 0.01, 100)
    ];
});
