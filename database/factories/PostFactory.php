<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use App\Enums\PostType;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $faker->addProvider(new \Faker\Provider\Youtube($faker));

    $postType = $faker->randomElement(PostType::getAll());

    $description = $postType === PostType::TEXT ? $faker->paragraph() : null;
    $file = null;

    if ($postType !== PostType::TEXT) {
        $file = $postType === PostType::VIDEO ? $faker->youtubeEmbedUri() : $faker->imageUrl();
    }

    $user = User::all()->random();

    return [
        'title' => $faker->sentence(),
        'description' => $description,
        'type' => $postType,
        'file' => $file,
        'user_id' => $user->id,
    ];
});
