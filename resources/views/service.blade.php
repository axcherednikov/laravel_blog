@extends('layout.master')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            Отправть уведомление
        </h3>

        @include('layout.errors')

        <form method="post" action="{{ route('service.send', [], false) }}">

            @csrf

            <div class="form-group">
                <label for="inputTitle">Заголовок уведомления</label>
                <input type="text"
                       class="form-control"
                       id="inputTitle"
                       name="title"
                       placeholder="Введите заголовок"
                       value="{{ old('title') }}"
                >
            </div>

            <div class="form-group">
                <label for="inputText">Текст уведомления</label>
                <textarea class="form-control" name="text" id="inputText" >{{ old('text') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>

@endsection
