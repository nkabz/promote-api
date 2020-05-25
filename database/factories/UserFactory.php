<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {
    $isSubscriber = [true, false];

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'subscriber' => $faker->randomElement($isSubscriber),
        'password' => Hash::make('password'),
        'remember_token' => Str::random(10),
    ];
});
