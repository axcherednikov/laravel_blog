@extends('layout.master')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            Список задач
        </h3>

        <a class="btn btn-primary" href="{{ route('tasks.create', [], false) }}" role="button">Новая задача</a>
        <br><br>
        <hr>

        @foreach($tasks as $task)
            @include('tasks.item')
        @endforeach

        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
        </nav>
    </div>

@endsection
