@extends('layout.master')

@section('title', 'Обновление статьи')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Обновление статьи
        </h3>

        @include('layout.errors')

        <form method="post" action="{{ route('posts.update', ['post' => $post->slug]) }}">

            @csrf
            @method('PATCH')

            @include('posts.forms')

            <button type="submit" class="btn btn-primary">Обновить статью</button>
        </form>
    </div>

@endsection
