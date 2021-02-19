<?php

namespace App\Http\Controllers\Posts;

use App\Events\Posts\PostCreated;
use App\Events\Posts\PostDeleted;
use App\Events\Posts\PostUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\TagRequest;
use App\Models\Post\Post;
use App\Services\TagService;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('can:update,post')->except(['index', 'create', 'store', 'show']);
    }

    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $postRequest, TagRequest $tagRequest, TagService $tagService)
    {
        $validatedData = $postRequest->validated();

        $validatedData['owner_id'] = auth()->id();

        $post = Post::create($validatedData);

        $tagService->setTags($post, $tagRequest->validated());

        event(new PostCreated($post));

        flash('Статья успешно создана');

        return redirect()->route('home');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, TagService $tagService, PostRequest $postRequest, TagRequest $tagRequest)
    {
        $post->update($postRequest->validated());

        $tagService->setTags($post, $tagRequest);

        flash('Статья успешно обновлена');

        event(new PostUpdated($post));

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        event(new PostDeleted($post));

        $post->delete();

        flash('Статья удалена', 'warning');

        return redirect()->route('home');
    }
}
