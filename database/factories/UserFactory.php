<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enums\UserType;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {
    $userTypes = UserType::getAll();

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'type' => $faker->randomElement($userTypes),
        'password' => Hash::make('password'), // password
        'remember_token' => Str::random(10),
    ];
});
