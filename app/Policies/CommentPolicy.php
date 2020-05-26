<?php

namespace App\Policies;

use App\Post;
use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Post $post, int $coinsAmount): bool
    {
        if (! $user->canPostMoreComments()) {
            return false;
        }

        if ($post->user->subscriber) {
            return true;
        }

        return $user->subscriber || $coinsAmount;
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id || $user->id === $comment->post->user_id;
    }
}
