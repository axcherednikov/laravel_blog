<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag\Tag;
use App\Models\Task\Task;
use App\Services\TagService;
use Illuminate\Database\Eloquent\Collection;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update,task')->except(['index', 'store', 'create']);
    }

    public function index()
    {
        $tasks = auth()->user()->tasks()->with('tags')->latest()->simplePaginate(3);

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

        $validatedData['owner_id'] = auth()->id();

        Task::create($validatedData);

        flash('Задача успешно создана');

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Task $task, TagService $tagService, TagRequest $tagRequest)
    {
        $validatedData = request()->validate([
            'title' => 'required',
            'body'  => 'required',
        ]);

        $task->update($validatedData);

        $tagService->setTags($task, $tagRequest);

        flash('Задача успешно обновлена');

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        flash('Задача удалена', 'warning');

        return redirect()->route('tasks.index');
    }
}
