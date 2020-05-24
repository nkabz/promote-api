<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use App\Comment;
use App\Enums\UserType;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {

    $post = Post::with('user')->inRandomOrder()->first();
    $user = $post->user->type === UserType::_PUBLIC
        ? User::all()->where('type', '!=',  UserType::_PUBLIC)->random()
        : User::all()->random();

    return [
        'content' => $faker->paragraph(),
        'user_id' => $user->id,
        'post_id' => $post->id,
    ];
});
