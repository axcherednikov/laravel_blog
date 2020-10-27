@extends('layout.master')

@section('title', 'Главная страница')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-4 mb-4 font-italic border-bottom">
            Статьи блога
        </h3>

        @if ($posts->count())
            @foreach ($posts as $post)
                @if ($post->publish)
                    @include('posts.item')
                @endif
            @endforeach
        @else
            <p>В данный момент статьи отсутствуют</p>
        @endif

        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Newer</a>
        </nav>

    </div>

@endsection
