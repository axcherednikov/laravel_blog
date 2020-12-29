@component('mail::message')
# Новые статьи за {{ $countPeriod }}:

@foreach($posts as $post)
{{ $post->description }}
@component('mail::button', ['url' => route('posts.show', ['post' => $post->slug])])
    Посмотреть статью
@endcomponent
@endforeach

Ждём Вас снова,<br>
{{ config('app.name') }}
@endcomponent
