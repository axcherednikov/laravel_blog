<?php

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $posts = $tag->posts()->with('tags')->get();
        $news = $tag->news()->with('tags')->get();

        return view('tags.index', compact('posts', 'news'));
    }
}
