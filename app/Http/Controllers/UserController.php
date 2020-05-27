<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Resources\CommentResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\TransactionResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service) {
        $this->service = $service;
    }

    public function comments(Request $request, User $user): ResourceCollection
    {
        $page = $request->has('page') ? $request->get('page') : 1;

        $comments = $this->service->getUserComments($user, $page);

        return CommentResource::collection($comments);
    }

    public function notifications(Request $request): ResourceCollection
    {
        $user = $request->user();

        $notifications = $this->service->getUserNotifications($user);

        return NotificationResource::collection($notifications);
    }

    public function buyCoins(Request $request): TransactionResource
    {
        $user = $request->user();
        $coinsAmount = $request->get('coinsAmount');

        $transaction = $this->service->buyCoins($user, $coinsAmount);

        return new TransactionResource($transaction);
    }
}
