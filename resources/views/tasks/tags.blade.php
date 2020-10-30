@php
    $tags = $tags ?? collect();
@endphp

@if($tags->isNotEmpty())
    <div>
        @foreach($tags as $tag)
            <a href="{{ route('tags.index', ['tag' => $tag->getRouteKey()], false) }}"
               class="badge badge-secondary">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif
