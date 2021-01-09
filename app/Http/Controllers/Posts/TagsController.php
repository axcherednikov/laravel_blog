<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Tag\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $posts = $tag->posts()->with('tags')->latest()->simplePaginate(5);

        return view('posts.index', compact('posts'));
    }
}
