@extends('admin.layout.master')

@section('title', 'Новости сайта')

@section('content')

    <div class="col-md-12 blog-main">

        <h1>Список новостей</h1>

        <br><br>
            <a class="btn btn-secondary" href="{{ route('admin.news.create', [], false) }}">Создать новость</a>
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
            @if($news->count())
                @foreach($news as $item)
                    <tr>
                        <th scope="row">{{ $item->id }}</th>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->updated_at->toDateString() }}</td>
                        <td>
                            <form action="{{ route('admin.news.destroy', ['news' => $item->slug], false) }}"
                                  method="POST">
                                @csrf
                                @method('DELETE')

                                <a href="{{ route('admin.news.edit', ['news' => $item->slug], false) }}"
                                   class="btn btn-outline-primary btn-sm">Изменить</a>

                                <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">
                        <h2>Новости отсутствуют</h2>
                    </td>
                </tr>
            @endif
            </tbody>
        </table>

        {{ $news->links() }}
    </div>

@endsection
