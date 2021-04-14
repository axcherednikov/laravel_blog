@extends('admin.layout.master')

@section('title', 'Отчёты')

@section('content')

    <div class="col-md-12 blog-main">
        <h1>Отчёты</h1>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Название</th>
                    <th scope="col">Действие</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Итого</td>
                    <td><a href="{{ route('admin.reports.total', [], false) }}" class="btn btn-info">Перейти</a></td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
