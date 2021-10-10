<?php

namespace App\Http\Controllers\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Task\Task;
use App\Services\TagService;
use Cache;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TasksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:update,task')->except(['index', 'store', 'create']);
    }

    public function index(): Factory|View|Application
    {
        $tasks = Cache::tags(['tasks'])->remember('user_tasks|' . auth()->id(), 3600, function () {
            return auth()->user()->tasks()->with('tags')->latest()->simplePaginate(3);
        });

        return view('tasks.index', compact('tasks'));
    }

    public function show(Task $task): Factory|View|Application
    {
        return view('tasks.show', compact('task'));
    }

    public function create(): Factory|View|Application
    {
        return view('tasks.create');
    }

    public function store(): RedirectResponse
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

    public function edit(Task $task): Factory|View|Application
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Task $task, TagService $tagService, TagRequest $tagRequest): RedirectResponse
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

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        flash('Задача удалена', 'warning');

        return redirect()->route('tasks.index');
    }
}
