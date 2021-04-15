@extends('admin.layout.master')

@section('title', 'Итого')

@section('content')

    <div class="col-md-12 blog-main">
        <h1>Итого</h1>
        <form action="{{ route('admin.reports.generate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="reports_list">Список</label>
                <select
                    multiple
                    size="{{ $models->count() }}"
                    class="form-control"
                    id="reports_list"
                    name="reports_list[]"
                >
                    @foreach($models as $class => $name)
                        <option value="{{ $class }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <br>

            <button type="submit" name="submit" class="btn btn-info">Сгенерировать отчёт</button>
        </form>
    </div>

@endsection
