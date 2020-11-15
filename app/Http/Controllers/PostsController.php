<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

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

        flash('Статья успешно создана');

        return redirect()->route('home');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $validatedData = $this->validate(request(), [
            'slug'        => [
                'nullable',
                'regex:~^[a-zA-Z0-9_-]+$~',
                'alpha_dash',
                Rule::unique('posts')->ignore($post->id),
            ],
            'title'       => [
                'required',
                'between:5,100',
                Rule::unique('posts')->ignore($post->id),
            ],
            'description' => 'required|max:255',
            'body'        => 'required',
            'publish'     => 'nullable|boolean',
        ]);

        $validatedData['slug'] = request('slug')
            ? request('slug')
            : Str::of(request('title'))->slug('-', 'en');

        $post->update($validatedData);

        flash('Статья успешно обновлена');

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        flash('Статья удалена', 'warning');

        return redirect()->route('home');
    }
}
