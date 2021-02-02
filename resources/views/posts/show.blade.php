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

        @if($post->comments()->count())

            <hr>

            @foreach($post->comments as $comment)
                <div class="shadow-sm p-3 mb-5 bg-white rounded">
                    <p class="text-muted">
                        {{ $comment->owner_name }} - {{ $comment->email }}
                    </p>

                    <p class="text-monospace">
                        {{ $comment->comment }}
                    </p>
                </div>
            @endforeach
        @endif
    </div>

@endsection
