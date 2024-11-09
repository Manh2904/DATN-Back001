<?php

/** @var Factory $factory */

use App\Models\Rating;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'r_user_id' => function () {
            return App\User::inRandomOrder()->first()->id;
        },
        'r_product_id' => function () {
            return App\Models\Product::inRandomOrder()->first()->id;
        },
        'r_number' => $faker->numberBetween(1, 5),
        'r_status' => 0,
        'r_content' => $faker->realText($maxNbChars = 50, $indexSize = 2),
    ];
});