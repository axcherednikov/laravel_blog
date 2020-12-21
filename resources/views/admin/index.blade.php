@extends('layout.master')

@section('title', 'Админ раздел')

@section('content')

    <div class="col-md-8 blog-main">
        <h1>Разделы</h1>
        <br><br>
        <p><a href="{{ route('admin.feedback.show', [], false) }}">Список обращений</a></p>
        <p><a href="{{ route('admin.posts.index', [], false) }}">Статьи</a></p>
    </div>

@endsection
