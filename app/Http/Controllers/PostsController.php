<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Str;

class PostsController extends Controller
{
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

    public function store()
    {
        $validatedData = $this->validate(request(), [
            'slug'        => 'nullable|regex:~^[a-zA-Z0-9_-]+$~|alpha_dash|unique:posts',
            'title'       => 'required|between:5,100|unique:posts',
            'description' => 'required|max:255',
            'body'        => 'required',
            'publish'     => 'nullable|boolean',
        ]);

        $validatedData['slug'] = request('slug')
            ? request('slug')
            : Str::of(request('title'))->slug('-', 'en');

        Post::create($validatedData);

        return redirect()->route('home');
    }
}
