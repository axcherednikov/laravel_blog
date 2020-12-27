@extends('layout.master')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Создание задачи
        </h3>

        @include('layout.errors')

        <form method="post" action="{{ route('tasks.update', ['task' => $task->id], false) }}">

            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="inputTitle">Название задачи</label>
                <input type="text"
                       class="form-control"
                       id="inputTitle"
                       name="title"
                       placeholder="Введите название задачи"
                       value="{{ old('title', $task->title) }}"
                >
            </div>

            <div class="form-group">
                <label for="inputBody">Описание задачи</label>
                <textarea class="form-control" name="body" id="inputBody" rows="10">{{ old('body', $task->body) }}</textarea>
            </div>

            <div class="form-group">
                <label for="inputTags">Тэги</label>
                <input type="text"
                       class="form-control"
                       id="inputTasksTags"
                       name="tags"
                       value="{{ old('tags', $task->tags->pluck('name')->implode(',')) }}"
                >
            </div>

            <button type="submit" class="btn btn-primary">Изменить задачу</button>
        </form>
    </div>

@endsection
