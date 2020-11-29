@component('mail::message')
# Статья {{ $post->title }} удалена

{{ $post->description }}

@component('mail::button', ['url' => route('home')])
    Перейти на сайт
@endcomponent

Ждём Вас снова, <br>
{{ config('app.name') }}
@endcomponent
