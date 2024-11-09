<?php

/** @var Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make(123456789),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'avatar' => $faker->optional($weight = 0.9)->userName,
        'remember_token' => Str::random(10)
    ];
}); 