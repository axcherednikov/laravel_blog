<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Tag\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $tasks = $tag->tasks()->with('tags')->latest()->simplePaginate(5);

        return view('tasks.index', compact('tasks'));
    }
}
