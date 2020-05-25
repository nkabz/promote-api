<?php

namespace App\Services;

use App\Post;
use App\User;
use App\Comment;
use Carbon\Carbon;
use App\Enums\TransactionType;
use Illuminate\Support\Facades\DB;

class CommentService
{
    public function createComment(User $user, Post $post, string $content): Comment
    {
        return $post->comments()->create([
            'user_id' => $user->id,
            'content' => $content,
        ]);
    }

    public function createHighlightComment(User $user, Post $post, string $content, int $coinsAmount): Comment
    {
        $expiresAt = Carbon::now()->addMinutes($coinsAmount);

        DB::beginTransaction();

        $comment = $post->comments()->create([
            'user_id' => $user->id,
            'content' => $content,
            'highlight_expires_at' => $expiresAt,
        ]);

        $transaction = $user->wallet->transactions()->create([
            'amount' => $coinsAmount,
            'type' => TransactionType::BALANCEOUT,
            'comment_id' => $comment->id,
        ]);

        $transaction->child()->create([
            'amount' => $coinsAmount * config('customs.transaction.percentage'),
            'type' => TransactionType::SERVER,
            'wallet_id' => $transaction->wallet_id,
        ]);

        $user->wallet->decrement('balance', $coinsAmount);

        DB::commit();

        return $comment;
    }
}
