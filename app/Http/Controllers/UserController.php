<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\CommentResource;
use App\Http\Resources\NotificationResource;

class UserController extends Controller
{
    public function comments(Request $request, User $user)
    {
        $page = $request->has('page') ? $request->get('page') : 1;

        $comments = Cache::remember("user.comments.{$user->id}.page.{$page}", now()->addMinutes(config('customs.cache.ttl')), function () use ($user) {
            return $user->comments()
                ->mostRecentActives()
                ->latest()
                ->paginate();
        });

        return CommentResource::collection($comments);
    }

    public function notifications(Request $request)
    {
        $notifications = $request->user()->availableNotifications;

        $notifications->markAsRead();

        return NotificationResource::collection($notifications);
    }
}
