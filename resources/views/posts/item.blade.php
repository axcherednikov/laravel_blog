<div class="blog-post">
    <h2 class="blog-post-title">
        <a href="{{ route('posts.show', ['post' => $post->slug], false) }}">{{ $post->title }}</a>
    </h2>

    <p>{{ $post->description }}</p>
    @include('posts.tags', ['tagsPost' => $post->tags])

    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>
</div>
