<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\Models\Post\Post;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $summary['count_posts'] = Post::count();

        $summary['count_news'] = News::count();

        $summary['max_count_posts_per_user'] = User::whereHas('posts')
            ->withCount('posts')
            ->orderByDesc('posts_count')
            ->first()
            ->name;

        $summary['max_length_posts'] = Post::selectRaw('length(body) as length_post, title, slug')
            ->orderByDesc('length_post')
            ->first();

        $summary['min_length_posts'] = Post::selectRaw('length(body) as length_post, title, slug')
            ->orderBy('length_post')
            ->first();

        $summary['posts_active_user'] = User::has('posts', '>')
            ->withCount('posts')
            ->get(['posts_count'])
            ->avg('posts_count');

        $summary['max_change_post'] = Post::whereHas('history')
            ->withCount('history')
            ->orderByDesc('history_count')
            ->first()
            ->title;

        $summary['max_comments_post'] = Post::whereHas('comments')
            ->withCount('comments')
            ->orderByDesc('comments_count')
            ->first()
            ->title;

        return view('admin.index', compact('summary'));
    }
}
