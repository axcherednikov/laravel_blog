<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use App\Models\Tag\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $news = $tag->news()->with('tags')->latest()->simplePaginate(5);

        return view('news.index', compact('news'));
    }
}
