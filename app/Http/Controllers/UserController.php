<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function notifications(Request $request)
    {
        $notifications = $request->user()->availableNotifications;

        $notifications->markAsRead();

        return NotificationResource::collection($notifications);
    }
}
