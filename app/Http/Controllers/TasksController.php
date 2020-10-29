<?php

namespace App\Http\Controllers;

use App\Task;

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

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
