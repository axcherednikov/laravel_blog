<div class="blog-post">
    <h2 class="blog-post-title">
        <a href="{{ route('news.show', ['news' => $item->slug], false) }}">{{ $item->title }}</a>
    </h2>

    <p>{{ $item->description }}</p>

    <p class="blog-post-meta">{{ $item->created_at->toFormattedDateString() }}</p>

    @admin
        <a href="#" class="btn btn-info">Редактировать</a>
    @endadmin
</div>
