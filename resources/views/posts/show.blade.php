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

        <form action="{{ route('posts.comments.store', ['post' => $post->slug], false) }}" method="post">

            @csrf

            <div class="row">

                <div class="col">
                    <div class="form-group">
                        <label for="emailCommentInput">Email</label>

                        <input type="email"
                               class="form-control form-control-sm"
                               id="emailCommentInput"
                               name="email"
                               value="{{ old('email') }}"
                        >
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="nameCommentInput">Имя</label>

                        <input type="text"
                               class="form-control form-control-sm"
                               id="nameCommentInput"
                               name="owner_name"
                               value="{{ old('owner_name') }}"
                        >
                    </div>
                </div>

            </div>

            <div class="form-group">
                <label for="textareaComment">Комментарий</label>
                <textarea class="form-control form-control-sm"
                          id="textareaComment"
                          rows="3"
                          name="comment">{{ old('comment') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Отправить</button>
        </form>

        <hr>

        @forelse($post->comments as $comment)
            <div class="shadow-sm p-3 mb-5 bg-white rounded">
                <p class="text-muted">
                    {{ $comment->owner_name }} - {{ $comment->email }}
                </p>

                <p class="text-monospace">
                    {{ $comment->comment }}
                </p>

                @admin
                <form action="{{ route('posts.comments.destroy', ['comment' => $comment->id], false) }}"
                      method="post">
                    @csrf

                    @method('DELETE')

                    <button class="btn btn-sm btn-danger" type="submit">Удалить</button>
                </form>
                @endadmin

            </div>
        @empty
            <p>Комментарии отсутствуют</p>
        @endforelse
    </div>

@endsection
