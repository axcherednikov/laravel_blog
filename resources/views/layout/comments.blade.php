@forelse($model->comments as $comment)
    <div class="shadow-sm p-3 mb-5 bg-white rounded">
        <p class="text-muted">
            {{ $comment->owner->name }} - {{ $comment->created_at->diffForHumans() }}
        </p>

        <p class="text-monospace">
            {{ $comment->comment }}
        </p>
    </div>
@empty
    <p class="text-monospace">Комментарии отсутствуют</p>
@endforelse
