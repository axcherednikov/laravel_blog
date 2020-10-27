<div class="blog-post">
    <h2 class="blog-post-title"><a href="/posts/{{ $post->slug }}">{{ $post->title }}</a></h2>

    <p>{{ $post->description }}</p>

    <p class="blog-post-meta">{{ $post->created_at->toFormattedDateString() }}</p>
</div>
