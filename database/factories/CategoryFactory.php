<?php

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    $name = $faker->randomElement(['Đồng hồ', 'Kính mát', 'Dây da']) . $faker->realText($maxNbChars = 25);
    return [
        'c_name' => $name,
        'c_slug' => Str::slug($name),
        'c_cate' => function () {
            if ('c_name' == 'Đồng hồ') return 'watch';
            else if ('c_name' == 'Kính mát') return 'glass';
            else return 'accessories';
        },
    ];
});
