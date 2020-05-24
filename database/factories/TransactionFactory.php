<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Comment;
use Carbon\Carbon;
use App\Transaction;
use Faker\Generator as Faker;
use App\Enums\TransactionType;

$factory->define(Transaction::class, function (Faker $faker) {

    $user = User::with('wallet')->inRandomOrder()->first();
    $comment = Comment::all()->random();

    $amount = $faker->numberBetween(10, 400);

    $comment->highlight_expire_at = Carbon::now()->addMinutes($amount);
    $comment->save();

    return [
        'type' => TransactionType::OUT,
        'amount' => $faker->numberBetween(10, 400),
        'wallet_id' => $user->wallet->id,
        'comment_id' => $comment->id,
    ];
});
