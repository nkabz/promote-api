<?php

namespace App\Policies;

use App\Post;
use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Post $post, $coinsAmount)
    {
        if (! $user->isCommentLimit() || $coinsAmount) {
            return false;
        }

        if ($post->user->subscriber) {
            return true;
        }

        return $user->subscriber;
    }

    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id || $user->id === $comment->post->user_id;
    }
}
