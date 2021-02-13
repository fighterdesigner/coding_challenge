<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->text(15),
        'description' => $faker->text(60),
        'price' => $faker->numberBetween($min = 10, $max = 50),
        'image_url' => $faker->text(25),
        'categorie' => $faker->text(10)
    ];
});
