<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\News\News;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(News $news, CommentRequest $request)
    {
        $news->comments()->create($request->all());

        flash('Комментарий добавлен');

        return back();
    }
}
