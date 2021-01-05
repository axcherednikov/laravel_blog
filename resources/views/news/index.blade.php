@extends('layout.master')

@section('title', 'Главная страница')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Новости
        </h3>

        @if ($news->count())
            @foreach ($news as $item)
                @if ($item->publish)
                    @include('news.item')
                @endif
            @endforeach

            {{ $news->links() }}

        @else
            <p>В данный момент новостей нет</p>
        @endif

    </div>

@endsection
