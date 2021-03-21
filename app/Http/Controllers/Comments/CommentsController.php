<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use App\Models\Comment\Comment;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroy(Comment $comment)
    {
        flash('Комментарий удален', 'warning');

        $comment->delete();

        return back();
    }
}
