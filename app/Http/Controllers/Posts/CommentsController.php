<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Post\Post;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post, CommentRequest $request)
    {
        $post->comments()->create($request->validated());

        flash('Комментарий добавлен');

        return back();
    }
}
