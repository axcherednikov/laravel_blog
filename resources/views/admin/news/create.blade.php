@extends('admin.layout.master')

@section('title', 'Создние новости')

@section('content')

    <div class="col-md-12 blog-main">

        <h2>
            Создать новость
        </h2>

        @include('layout.errors')

        @include('admin.forms.news', [
            'route' => 'admin.news.store',
            'submit' => 'Создать',
            'news' => new \App\Models\News\News(),
        ])

    </div>

@endsection
