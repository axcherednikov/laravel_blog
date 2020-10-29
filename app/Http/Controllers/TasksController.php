<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Task;
use Illuminate\Database\Eloquent\Collection;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::with('tags')->latest()->get();

        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store()
    {
        $validatedData = $this->validate(request(), [
            'title' => 'required',
            'body'  => 'required',
        ]);

        Task::create($validatedData);

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Task $task)
    {
        $validatedData = request()->validate([
            'title' => 'required',
            'body'  => 'required',
        ]);

        $task->update($validatedData);

        /** @var Collection $taskTags */
        $taskTags = $task->tags->keyBy('name');

        $tags = collect(explode(',', request('tags')))->keyBy(fn ($item) => $item);

        $syncIds = $taskTags->intersectByKeys($tags)->pluck('id')->toArray();

        $tagsToAttach = $tags->diffKeys($taskTags);

//        $tagsToDetach = $taskTags->diffKeys($tags);
//
//        foreach ($tagsToAttach as $tag) {
//            $tag = Tag::firstOrCreate(['name' => $tag]);
//            $task->tags()->attach($tag);
//        }
//
//        foreach ($tagsToDetach as $tag) {
//            $task->tags()->detach($tag);
//        }

        foreach ($tagsToAttach as $tag) {
            $tag = Tag::firstOrCreate(['name' => $tag]);
            $syncIds[] = $tag->id;
        }

        $task->tags()->sync($syncIds);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
