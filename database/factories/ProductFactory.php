<?php

use App\Models\Admin;
use App\Models\Category;
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $name = $faker->randomElement(['Đồng hồ', 'Kính mát', 'Dây da']) . $faker->realText($maxNbChars = 25);
    return [
        'pro_name' => $name,
        'pro_slug' => Str::slug($name),
        'pro_amount' => $faker->numberBetween($min = 10, $max = 1000),
        'pro_price' => $faker->numberBetween($min = 1000000, $max = 20000000),
        'pro_sale' => $faker->numberBetween($min = 0, $max = 100),
        'pro_view' => $faker->numberBetween($min = 0, $max = 2000),
        'pro_category' => function () {
            return $faker->numberBetween($min == Category::min('id'), $max = Category::max('id'));
        },
        'pro_admin_id' => function () {
            return $faker->numberBetween($min = Admin::min('id'), $max = Admin::max('id'));
        },
        'pro_avatar' => $faker->image('public/uploads', 640, 480, null, false),
        'pro_description' => 'Đang cập nhật',
        'pro_content' => 'Đang cập nhật',
        '_wysihtml5_mode' => '1',
    ];
});
