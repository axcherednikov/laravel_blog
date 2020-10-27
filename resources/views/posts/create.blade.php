@extends('layout.master')

@section('title', 'Создание статьи')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Создание статьи
        </h3>

        @include('layout.errors')

        <form method="post" action="/posts">

            @csrf

            <div class="form-group">
                <label for="inputSlug">URL статьи</label>
                <input type="text" class="form-control" id="inputSlug" name="slug" placeholder="Введите URL статьи"
                       value="{{ old('slug') }}">
                <small id="slugHelp" class="form-text text-muted">
                    URL должен быть уникальным для всего сайта, или оставьте данное поле пустым оно сгенерируется
                    автоматически
                </small>
            </div>
            <br>

            <div class="form-group">
                <label for="inputTitle">Название статьи</label>
                <input type="text" class="form-control" id="inputTitle" name="title"
                       placeholder="Введите название статьи" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="inputDescription">Краткое описание статьи</label>
                <input type="text" class="form-control" id="inputDescription" name="description"
                       placeholder="Введите краткое описание" value="{{ old('description') }}">
            </div>

            <div class="form-group">
                <label for="bodyInput">Текст статьи</label>
                <textarea class="form-control" id="bodyInput" name="body" rows="3">{{ old('body') }}</textarea>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" id="inputPublish" name="publish">
                <label class="form-check-label" for="inputPublish">
                    Опубликовать статью
                </label>
            </div>

            <br><br>
            <button type="submit" class="btn btn-primary">Создать статью</button>
        </form>
    </div>

@endsection
