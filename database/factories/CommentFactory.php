<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use App\Comment;
use App\Enums\UserType;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {

    $post = Post::with('user')->inRandomOrder()->first();
    $user = $post->user->subscriber === true
        ? User::all()->random()
        : User::all()->where('subscriber', true)->random();

    return [
        'content' => $faker->paragraph(),
        'user_id' => $user->id,
        'post_id' => $post->id,
    ];
});
