@extends('layout.master')

@section('title', $post->title)

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ $post->title }}
        </h3>

        <p class="blog-post-meta">{{ $post->updated_at->toFormattedDateString() }}</p>
        <p>{{ $post->body }}</p>

        @include('tags.show', ['tagsPost' => $post->tags])

        <br>
        @can('update', $post)
            <form action="{{ route('posts.destroy', ['post' => $post->slug], false) }}" method="post">

                @csrf
                @method('DELETE')

                <a class="btn btn-primary" href="{{ route('posts.edit', ['post' => $post->slug], false) }}"
                   role="button">
                    Редактировать
                </a>

                <input class="btn btn-danger" type="submit" value="Удалить">
            </form>
        @endcan

        <hr>

        <h3 class="pb-3 mb-4 font-italic">
            История изменений статьи
        </h3>

        @admin

        {{--        @dd($post->history->toArray())--}}

        @forelse($post->history as $item)

            <p>
                Email: {{ $item->email }}.
                Добавлена: {{ $item->created_at->diffForHumans() }}.
                Изменена: {{ $item->pivot->created_at->diffForHumans() }}.
            </p>

            <b>До: </b>
            @foreach(json_decode($item->pivot->before) as $key => $value)

                <p>Поле: {{ $key }} - Значение: {{ $value }}</p>
            @endforeach

            <b>После: </b>
            @foreach(json_decode($item->pivot->after) as $key => $value)
                <p>Поле: {{ $key }} - Значение: {{ $value }}</p>
            @endforeach

            <hr>
        @empty
            <p>История измений отсутствует</p>

            <hr>
        @endforelse

        @endadmin

        <br><br>

        <h3 class="pb-3 mb-4 font-italic">
            Коментарии к статье
        </h3>

        @include('layout.errors')

        @auth
            @include('forms.comments', [
                'route' => 'posts.comments.store',
                'modelType' => 'post',
                'model' => $post,
            ])
        @endauth

        <hr>

        @include('layout.comments', ['model' => $post])
    </div>

@endsection
