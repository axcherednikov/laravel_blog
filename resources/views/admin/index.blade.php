@extends('admin.layout.master')

@section('title', 'Админ раздел')

@section('content')

    <div class="col-md-12 blog-main">
        <h1>Статистика</h1>

        <br>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Статистика</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Количество статей</td>
                <td>{{ $summary['count_posts'] }}</td>
            </tr>
            <tr>
                <td>Количество новостей</td>
                <td>{{ $summary['count_news'] }}</td>
            </tr>
            <tr>
                <td>Автор с наибольшим количеством статей</td>
                <td>{{ $summary['max_count_posts_per_user'] }}</td>
            </tr>
            <tr>
                <td>Автор с наибольшим количеством статей</td>
                <td>{{ $summary['max_count_posts_per_user'] }}</td>
            </tr>
            <tr>
                <td>Самая длинная статья</td>
                <td>
                    Название - {{ $summary['max_length_posts']->title }}
                    <br>
                    Длина - {{ $summary['max_length_posts']->length_post }}
                    <br>
                    Ссылка - <a href="{{ route('posts.show', ['post' => $summary['max_length_posts']->slug], false) }}">
                                {{ $summary['max_length_posts']->slug }}
                            </a>
                </td>
            </tr>
            <tr>
                <td>Самая короткая статья</td>
                <td>
                    Название - {{ $summary['min_length_posts']->title }}
                    <br>
                    Длина - {{ $summary['min_length_posts']->length_post }}
                    <br>
                    Ссылка - <a href="{{ route('posts.show', ['post' => $summary['min_length_posts']->slug], false) }}">
                                {{ $summary['min_length_posts']->slug }}
                            </a>
                </td>
            </tr>
            <tr>
                <td>Среднее количество статей у активных пользователей</td>
                <td>{{ $summary['posts_active_user'] }}</td>
            </tr>
            <tr>
                <td>Среднее количество статей у активных пользователей</td>
                <td>{{ $summary['posts_active_user'] }}</td>
            </tr>
            <tr>
                <td>Часто изменяемая статья</td>
                <td>{{ $summary['max_change_post'] }}</td>
            </tr>
            <tr>
                <td>Самая комментируемая статья</td>
                <td>{{ $summary['max_comments_post'] }}</td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection
