<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StorePostRequest;
use App\Http\Requests\Api\V1\UpdatePostRequest;
use App\Http\Resources\Api\V1\PostResource;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::with('category', 'user')->paginate(10));
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $post = Post::create($data);
        $post->load(['user', 'category']);

        return new PostResource($post);
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        // Apenas o autor pode atualizar
        if ($post->user_id !== auth()->id()) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $post->update($request->validated());
        $post->load(['user', 'category']);

        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $post->delete();
        return response()->json(['message' => 'Post excluído com sucesso']);
    }

}
