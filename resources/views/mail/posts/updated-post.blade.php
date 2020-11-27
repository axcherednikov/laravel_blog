@component('mail::message')
    # Статья {{ $post->title }} обновлена!

    {{ $post->description }}

    @component('mail::button', ['url' => route('posts.show', ['post' => $post->slug])])
        Посмотреть статью
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
