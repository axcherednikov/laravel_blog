@php
    $tagsTask = $tagsTask ?? collect();
@endphp

@if($tagsTask->isNotEmpty())
    <div>
        @foreach($tagsTask as $tag)
            <a href="{{ route('tags.index', ['tag' => $tag->getRouteKey()], false) }}"
               class="badge badge-secondary">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif
