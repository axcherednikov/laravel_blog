@extends('layout.master')

@section('title', $news->title)

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ $news->title }}
        </h3>

        <p class="blog-post-meta">{{ $news->updated_at->toFormattedDateString() }}</p>
        <p>{{ $news->body }}</p>

        <hr>
        <a class="btn btn-secondary" href="{{ back()->getTargetUrl() }}">Вернуться к новостям</a>
    </div>

@endsection
