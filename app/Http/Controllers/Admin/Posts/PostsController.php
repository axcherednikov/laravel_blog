<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\TagRequest;
use App\Models\Post\Post;
use App\Services\PostsService;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();

        return view('admin.posts.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Post $post, PostsService $postsService, PostRequest $postRequest, TagRequest $tagRequest)
    {
        $postsService->postUpdate($post, $tagRequest, $postRequest);

        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        flash('Статья удалена', 'warning');

        return redirect()->route('admin.posts.index');
    }
}
