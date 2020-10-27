@extends('layout.master')

@section('title', 'Контакты')

@section('content')

    <div class="col-md-8 blog-main">
        <h1 class="mt-5">Наши контакты</h1>
        <hr>
        <p class="lead">По всем вопросам обращаться сюда:</p>
        <p>Email: <a href="mailto:">info@laravel.test</a></p>
        <br><br>
        <h3>Форма обратной связи</h3>
        <br><br>

        @include('layout.errors')

        <form method="post" action="/contacts">

            @csrf

            <div class="form-group">
                <label for="email-feedback">Ваш email:</label>
                <input type="email" class="form-control" id="email-feedback" name="email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="message-feedback">Ваше сообщение: </label>
                <textarea class="form-control" id="message-feedback" name="message" rows="3">{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>

@endsection
