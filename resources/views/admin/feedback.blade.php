@extends('layout.master')

@section('title', 'Список обращений')

@section('content')

    <div class="col-md-8 blog-main">
        <h1>Список обращений</h1>
        <br><br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Email</th>
                <th scope="col">Сообщение</th>
                <th scope="col">Дата создания</th>
            </tr>
            </thead>
            <tbody>

            @foreach($feedbacks as $feedback)
                <tr>
                    <th scope="row">{{ $feedback->id }}</th>
                    <td>{{ $feedback->email }}</td>
                    <td>{{ $feedback->message }}</td>
                    <td>{{ $feedback->created_at->toFormattedDateString() }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection
