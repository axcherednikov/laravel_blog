@extends('admin.layout.master')

@section('title', 'Все статьи сайта')

@section('content')

    <div class="col-md-12 blog-main">
        <h1>Список статей</h1>
        <br><br>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Название</th>
                <th scope="col">Дата обновления</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @if($posts->count())
                @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->updated_at->toDateString() }}</td>
                        <td>
                            <form action="{{ route('admin.posts.destroy', ['post' => $post->slug], false) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('admin.posts.edit', ['post' => $post->slug], false) }}"
                                   class="btn btn-outline-primary btn-sm">Изменить</a>

                                <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">
                        <h2>Статьи отсутствуют</h2>
                    </td>
                </tr>
            @endif

            </tbody>
        </table>

        {{ $posts->links() }}
    </div>

@endsection
