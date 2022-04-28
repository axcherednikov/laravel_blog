<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag\Tag;
use Illuminate\Support\Facades\Cache;

class TagsController extends Controller
{
    public function index(string $tag)
    {
        $posts = Cache::tags(['tags', 'posts'])->rememberForever(
            'posts_tags_id_' . $tag,
            fn() => Tag::whereName($tag)->firstOrFail()->posts()->with('tags')->get()
        );

        $news = Cache::tags(['tags', 'news'])->rememberForever(
            'news_tags_id_' . $tag,
            fn() => Tag::whereName($tag)->firstOrFail()->news()->with('tags')->get()
        );

        return view('tags.index', compact('posts', 'news'));
    }
}
