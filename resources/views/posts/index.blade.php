@extends('layout.master')

@section('title', 'Главная страница')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Статьи блога
        </h3>

        @if ($posts->count())
            @foreach ($posts as $post)
                @if ($post->publish)
                    @include('posts.item')
                @endif
            @endforeach

            {{ $posts->links() }}
        @else
            <h3>В данный момент статьи отсутствуют</h3>
        @endif
    </div>

@endsection
