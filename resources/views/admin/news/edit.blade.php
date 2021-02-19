@extends('admin.layout.master')

@section('title', 'Обновление новости')

@section('content')

    <div class="col-md-12 blog-main">

        <h2>
            Обновление новости
        </h2>

        @include('layout.errors')

        @include('admin.forms.news', [
            'submit' => 'Обновить',
            'route' => 'admin.news.update',
            'method' => 'PATCH',
        ])

    </div>

@endsection
