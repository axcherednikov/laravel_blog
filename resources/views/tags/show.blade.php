@php
    $tagsPost = $tagsPost ?? collect();
    $tagsNews = $tagsNews ?? collect();
    $tagsTask = $tagsTask ?? collect();
    $tagsStep = $tagsStep ?? collect();
@endphp

@if($tagsTask->isNotEmpty())
    <div>
        @foreach($tagsTask as $tag)
            <a href="{{ route('tasks.tags.index', ['tag' => $tag->getRouteKey()], false) }}"
               class="badge badge-secondary">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif

@if($tagsPost->isNotEmpty())
    <div>
        @foreach($tagsPost as $tag)
            <a href="{{ route('posts.tags.index', ['tag' => $tag->getRouteKey()], false) }}"
               class="badge badge-secondary">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif

@if($tagsNews->isNotEmpty())
    <div>
        @foreach($tagsNews as $tag)
            <a href="{{ route('news.tags.index', ['tag' => $tag->getRouteKey()], false) }}"
               class="badge badge-secondary">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif

@if($tagsStep->isNotEmpty())
    <div>
        @foreach($tagsStep as $tag)
            <p class="badge badge-secondary">{{ $tag->name }}</p>
        @endforeach
    </div>
@endif
