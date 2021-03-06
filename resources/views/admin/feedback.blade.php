@extends('admin.layout.master')

@section('title', 'Список обращений')

@section('content')

    <div class="col-md-12 blog-main">
        <h1>Список обращений</h1>
        <br><br>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Email</th>
                <th scope="col">Сообщение</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
            @if($feedbacks->count())
                @foreach($feedbacks as $feedback)
                    <tr>
                        <th scope="row">{{ $feedback->id }}</th>
                        <td>{{ $feedback->email }}</td>
                        <td>{{ $feedback->message }}</td>
                        <td>{{ $feedback->created_at->toFormattedDateString() }}</td>
                        <td>
                            <form action="{{ route('admin.feedback.destroy', ['feedback' => $feedback->id], false)}}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-sm btn-outline-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4"><h2>Обращения отсутствуют</h2></td>
                </tr>
            @endif
            </tbody>
        </table>

        {{ $feedbacks->links() }}
    </div>

@endsection
