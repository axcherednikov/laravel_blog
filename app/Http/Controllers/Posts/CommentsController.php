<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Post\Post;

class CommentsController extends Controller
{
    public function store(Post $post, CommentRequest $request)
    {
        $post->comments()->create($request->validated());

        flash('Комментрий добавлен');

        return back();
    }
}
