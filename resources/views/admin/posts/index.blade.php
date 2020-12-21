@extends('layout.master')

@section('title', 'Все статьи сайта')

@section('content')

    <div class="col-md-8 blog-main">
        @if($posts->count())
            <div class="list-group">

                @foreach($posts as $post)
                    <a href="{{ route('admin.posts.edit', ['post' => $post->slug], false) }}" class="list-group-item list-group-item-action">
                        {{ $post->title }}
                    </a>
                @endforeach

            </div>
        @endif
    </div>

@endsection
