@component('mail::message')
# Создана новая задача: {{ $post->title }}

{{ $post->description }}

@component('mail::button', ['url' => route('posts.show', ['post' => $post->slug])])
    Посмотреть статью
@endcomponent

Ждём Вас снова,<br>
{{ config('app.name') }}
@endcomponent
