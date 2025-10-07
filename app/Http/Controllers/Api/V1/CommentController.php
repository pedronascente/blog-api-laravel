<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\Api\V1\CommentResource;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        return CommentResource::collection($post->comments()->with('user')->get());
    }

    public function store(StoreCommentRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['post_id'] = $post->id;

        $comment = Comment::create($data);
        $comment->load('user');

        return new CommentResource($comment);
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== auth()->id()) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $comment->delete();
        return response()->json(['message' => 'Comentário excluído com sucesso']);
    }

}
