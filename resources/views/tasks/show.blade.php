@extends('layout.master')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ $task->title }}
        </h3>

        {{ $task->body }}

        <br><br>
        <form method="post" action="{{ route('tasks.destroy', ['task' => $task->id], false) }}">

            @csrf
            @method('DELETE')

            <a class="btn btn-primary" href="{{ route('tasks.edit', ['task' => $task->id], false) }}" role="button">Изменить</a>
            <button class="btn btn-danger" type="submit">Удалить</button>

        </form>
        <hr>

        <a href="{{ route('tasks.index', [], false) }}">Вернуться к списку задач.</a>
    </div>

@endsection
