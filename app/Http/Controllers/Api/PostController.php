<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $orderColumn = request('order_column', 'created_at');
        if (! in_array($orderColumn, ['id', 'title', 'created_at'])) { 
            $orderColumn = 'created_at';
        } 
        $orderDirection = request('order_direction', 'desc');
        if (! in_array($orderDirection, ['asc', 'desc'])) { 
            $orderDirection = 'desc';
        } 
 
        $posts = Post::with('category')
            ->when(request('category'), function (Builder $query) {
                $query->where('category_id', request('category'));
            })
            ->orderBy($orderColumn, $orderDirection)
            ->paginate(10);
 
        return PostResource::collection($posts);
    }

    public function store(StorePostRequest $request)
    {
        Gate::authorize('posts.create'); 
        if ($request->hasFile('thumbnail')) { 
            $filename = $request->file('thumbnail')->getClientOriginalName();
            info($filename);
        } 
        $post = Post::create($request->validated());
 
        return new PostResource($post);
    }


    public function show(Post $post)
    {
        Gate::authorize('posts.update'); 

        return new PostResource($post);
    }

    public function update(Post $post, StorePostRequest $request)
    {
        Gate::authorize('posts.update'); 

        $post->update($request->validated());
 
        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        Gate::authorize('posts.delete'); 

        $post->delete();
 
        return response()->noContent();
    }
}
