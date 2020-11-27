@php
    $tagsPost = $tagsPost ?? collect();
@endphp

@if($tagsPost->isNotEmpty())
    <div>
        @foreach($tagsPost as $tag)
            <a href="{{ route('posts.tags.index', ['tag' => $tag->getRouteKey()]) }}"
               class="badge badge-dark">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif
