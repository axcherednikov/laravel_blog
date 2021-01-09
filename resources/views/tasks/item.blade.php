<div class="blog-post">
    <h2 class="blog-post-title">
        <a href="{{ route('tasks.show', ['task' => $task->id], false) }}">{{ $task->title }}</a>
    </h2>

    <p class="blog-post-meta">{{ $task->created_at->toFormattedDateString() }}</p>

    @include('tags.show', ['tagsTask' => $task->tags])

    {{ $task->body }}
</div>
