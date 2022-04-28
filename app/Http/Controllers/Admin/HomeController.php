<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use App\Models\Post\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $summary['count_posts'] = Cache::tags(['posts'])->rememberForever(
            'posts_count',
            fn() => Post::count()
        );

        $summary['count_news'] = Cache::tags(['news'])->rememberForever(
            'news_count',
            fn() => News::count()
        );

        $summary['max_count_posts_per_user'] = Cache::tags(['users', 'posts'])->rememberForever(
            'max_count_posts_per_user',
            fn() => User::whereHas('posts')
                ->withCount('posts')
                ->orderByDesc('posts_count')
                ->first()
                ->name
        );

        $summary['max_length_posts'] = Cache::tags(['posts'])->rememberForever(
            'max_length_posts',
            fn() => Post::selectRaw('length(body) as length_post, title, slug')
                ->orderByDesc('length_post')
                ->first()
        );

        $summary['min_length_posts'] = Cache::tags(['posts'])->rememberForever(
            'min_length_posts',
            fn() => Post::selectRaw('length(body) as length_post, title, slug')
                ->orderBy('length_post')
                ->first()
        );

        $summary['posts_active_user'] = Cache::tags(['posts, users'])->rememberForever(
            'posts_active_user',
            fn() => User::has('posts', '>')
                ->withCount('posts')
                ->get(['posts_count'])
                ->avg('posts_count')
        );

        $summary['max_change_post'] = Cache::tags(['posts', 'history'])->rememberForever(
            'max_change_post',
            fn() => Post::whereHas('history')
                ->withCount('history')
                ->orderByDesc('history_count')
                ->first()
        );

        $summary['max_comments_post'] = Cache::tags(['posts', 'comments'])->rememberForever(
            'max_comments_post', fn() => Post::whereHas('comments')
            ->withCount('comments')
            ->orderByDesc('comments_count')
            ->first()
        );

        return view('admin.index', compact('summary'));
    }
}
