<?php

use App\Models\Keyword;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Keyword::class, function (Faker $faker) {
    $name = $faker->sentence($nbWords = 15, $variableNbWords = true);
    return [
        'k_name' => $name,
        'k_slug' => Str::slug($name),
        'k_description' => Str::slug($name),
        'k_slug' => text($maxNbChars = 200),
    ];
});
