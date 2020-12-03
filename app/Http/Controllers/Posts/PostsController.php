<?php

namespace App\Http\Controllers\Posts;

use App\Events\Posts\PostCreated;
use App\Events\Posts\PostDeleted;
use App\Events\Posts\PostUpdated;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post\Post;
use App\Services\PostsService;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('can:update,post')->except(['index', 'create', 'store', 'show']);
    }

    public function index()
    {
        $posts = Post::latest()->get();

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

    public function store(PostRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['owner_id'] = auth()->id();

        $post = Post::create($validatedData);

        PostsService::setTags($post);

        event(new PostCreated($post));

        flash('Статья успешно создана');

        return redirect()->route('home');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->validated());

        PostsService::setTags($post);

        event(new PostUpdated($post));

        flash('Статья успешно обновлена');

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
