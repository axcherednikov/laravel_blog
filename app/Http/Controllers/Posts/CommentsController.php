<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment\Comment;
use App\Models\Post\Post;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Post $post, CommentRequest $request)
    {
        $post->comments()->create([
            'comment' => $request->comment,
            'owner_id' => $request->user()->id,
        ]);

        flash('Комментрий добавлен');

        return back();
    }

    public function destroy(Comment $comment)
    {
        flash('Комментарий удален', 'warning');

        $comment->delete();

        return back();
    }
}
