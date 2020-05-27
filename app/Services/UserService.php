<?php

namespace App\Services;

use App\User;
use App\Enums\TransactionType;
use App\Transaction;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class UserService
{
    public function getUserComments(User $user, int $page): LengthAwarePaginator
    {
        return Cache::remember("user.comments.{$user->id}.page.{$page}", now()->addMinutes(config('customs.cache.ttl')), function () use ($user) {
            return $user->comments()
                ->mostRecentActives()
                ->latest()
                ->paginate();
        });
    }

    public function getUserNotifications(User $user): DatabaseNotificationCollection
    {
        $notifications = $user->availableNotifications;

        $notifications->markAsRead();

        return $notifications;
    }

    public function buyCoins(User $user, int $coinsAmount): Transaction
    {
        DB::beginTransaction();

        $transaction = $user->wallet->transactions()->create([
            'amount' => $coinsAmount,
            'type' => TransactionType::BALANCEIN,
        ]);

        $user->wallet()->increment('balance', $coinsAmount);

        DB::commit();

        return $transaction;
    }
}
