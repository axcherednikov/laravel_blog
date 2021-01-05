@extends('admin.layout.master')

@section('title', 'Все статьи сайта')

@section('content')

    <div class="col-md-12 blog-main">
        <h1>Список новостей</h1>
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
                            <a href="#" class="btn btn-outline-primary btn-sm">Изменить</a>
                            <a href="#" class="btn btn-outline-danger btn-sm">Удалить</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4"><h2>Новости отсутствуют</h2></td>
                </tr>
            @endif
            </tbody>
        </table>

        {{ $news->links() }}
    </div>

@endsection
