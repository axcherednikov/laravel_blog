@php
    $tags = $tags ?? collect();
@endphp

@if($tags->isNotEmpty())
    <div>
        @foreach($tags as $tag)
            <a href="{{ route('tasks.tags.index', ['tag' => $tag->getRouteKeyName()], false) }}"
               class="badge badge-secondary">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif
