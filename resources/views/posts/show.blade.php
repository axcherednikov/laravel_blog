@extends('layout.master')

@section('title', $post->title)

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ $post->title }}
        </h3>

        <p class="blog-post-meta">{{ $post->updated_at->toFormattedDateString() }}</p>
        <p>{{ $post->body }}</p>

        <br>
        <hr>
        <a href="/">Вернуться на главную страницу</a>
    </div>

@endsection
