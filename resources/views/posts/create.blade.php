@extends('layout.master')

@section('title', 'Создание статьи')

@section('content')

    <div class="col-md-8 blog-main">

        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Создание статьи
        </h3>

        @include('layout.errors')

        @include('forms.posts', [
            'route' => 'posts.store',
            'post' => new \App\Models\Post\Post(),
            'submit' => 'Создать'
        ])

    </div>

@endsection
