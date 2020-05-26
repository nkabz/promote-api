<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use App\Services\CommentService;
use App\Http\Resources\CommentResource;
use App\Http\Requests\StoreCommentRequest;
use App\Notifications\CommentCreated;

class CommentController extends Controller
{
    protected $service;

    public function __construct(CommentService $service) {
        $this->service = $service;
    }

    public function index(Post $post)
    {
        return CommentResource::collection($post->comments()->paginate());
    }

    public function store(StoreCommentRequest $request, Post $post)
    {
        $user = $request->user();
        $content = $request->get('content');
        $coinsAmount = $request->get('coinsAmount');

        $this->authorize('create', [
            Comment::class, $post, $coinsAmount
        ]);

        $comment = $coinsAmount
            ? $this->service->createHighlightComment($user, $post, $content, $coinsAmount)
            : $this->service->createComment($user, $post, $content);

        $post->user->notify(new CommentCreated($user));

        return new CommentResource($comment);
    }

    public function destroy(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json(['message' => 'The comment has been deleted!']);
    }
}
