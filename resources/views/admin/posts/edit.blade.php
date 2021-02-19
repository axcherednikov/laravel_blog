@extends('admin.layout.master')

@section('title', 'Обновление статьи')

@section('content')

    <div class="col-md-12 blog-main">

        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Обновление статьи
        </h3>

        @include('layout.errors')

        @include('forms.posts', [
            'route' => 'admin.posts.update',
            'method' => 'PATCH',
            'submit' => 'Обновить',
        ])

    </div>

@endsection
