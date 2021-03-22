@extends('layout.master')

@section('title', 'Вывод статей и новостей по тэгам')

@section('content')
    <div class="col-md-4">

        <h2 class="h2">Новости</h2>

        <br>

        @forelse($news as $newsItem)
            <a href="{{ route('news.show', ['news' => $newsItem]) }}">
                <h3 class="h4">
                    {{ $newsItem->title }}
                </h3>
            </a>
            <hr>
        @empty
            <p>Новости отсутствуют</p>
        @endforelse
    </div>
    <div class="col-md-4">

        <h2>Статьи</h2>

        <br>

        @forelse($posts as $post)
            <a href="{{ route('posts.show', ['post' => $post]) }}">
                <h3 class="h4">
                    {{ $post->title }}
                </h3>
            </a>
            <hr>
        @empty
            <p>Статьи отсутствуют</p>
        @endforelse
    </div>
@endsection
