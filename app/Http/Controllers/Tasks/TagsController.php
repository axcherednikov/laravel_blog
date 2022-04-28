<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Tag\Tag;
use Illuminate\Support\Facades\Cache;

class TagsController extends Controller
{
    public function index(int $id)
    {
        $tasks = Cache::tags(['tags', 'tasks'])->rememberForever(
            'tasks_tag_id_' . $id,
            fn() => Tag::findOrFail($id)
                ->tasks()
                ->with('tags')
                ->latest()
                ->simplePaginate(5)
        );

        return view('tasks.index', compact('tasks'));
    }
}
