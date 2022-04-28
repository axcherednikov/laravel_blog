<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\News\News;
use Illuminate\Support\Facades\Cache;

class NewsController extends Controller
{
    public function index()
    {
        $news = Cache::tags(['news'])->rememberForever(
            'news_all',
            fn() => News::latest()->simplePaginate(10)
        );

        return view('news.index', compact('news'));
    }

    public function show(string $news)
    {
        $news = Cache::tags(['news'])->rememberForever(
            'news_slug_' . $news,
            fn() => News::whereSlug($news)->firstOrFail()
        );

        return view('news.show', compact('news'));
    }
}
