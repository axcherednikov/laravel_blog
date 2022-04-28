<?php

namespace App\Http\Controllers\Admin\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\TagRequest;
use App\Models\Post\Post;
use App\Services\TagService;
use Illuminate\Support\Facades\Cache;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Cache::tags(['posts'])->rememberForever(
            'posts_all_admin',
            fn () => Post::latest('id')->simplePaginate(20)
        );

        return view('admin.posts.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Post $post, TagService $tagService, PostRequest $postRequest, TagRequest $tagRequest)
    {
        $post->update($postRequest->validated());

        $tagService->setTags($post, $tagRequest);

        flash('Статья успешно обновлена');

        return redirect()->route('admin.posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        flash('Статья удалена', 'warning');

        return redirect()->route('admin.posts.index');
    }
}
