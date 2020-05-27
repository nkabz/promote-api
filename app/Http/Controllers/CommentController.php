<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Resources\CommentResource;
use App\Http\Requests\StoreCommentRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentController extends Controller
{
    protected $service;

    public function __construct(CommentService $service) {
        $this->service = $service;
    }

    public function index(Request $request, Post $post): ResourceCollection
    {
        $page = $request->input('page', 1);

        $comments = $this->service->getCommentsByPost($post, $page);

        return CommentResource::collection($comments);
    }

    public function store(StoreCommentRequest $request, Post $post): CommentResource
    {
        $user = $request->user();
        $content = $request->get('content');
        $coinsAmount = $request->get('coinsAmount');

        $this->authorize('create', [
            Comment::class, $post, $coinsAmount
        ]);

        $comment = $this->service->createComment($user, $post, $content, $coinsAmount);

        return new CommentResource($comment);
    }

    public function destroy(Post $post, Comment $comment): JsonResponse
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json(['message' => 'The comment has been deleted!']);
    }
}
