<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Http\Resources\NotificationResource;

class UserController extends Controller
{
    public function comments(User $user)
    {
        $comments = $user
            ->comments()
            ->mostrecentactives()
            ->latest()
            ->paginate();

        return CommentResource::collection($comments);
    }

    public function notifications(Request $request)
    {
        $notifications = $request->user()->availableNotifications;

        $notifications->markAsRead();

        return NotificationResource::collection($notifications);
    }
}
