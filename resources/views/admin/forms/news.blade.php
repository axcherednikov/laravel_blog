<form method="POST" action="{{ route($route, isset($news->slug) ? ['news' => $news->slug] : [], false) }}">
    @csrf

    @isset($method)
        @method($method)
    @endisset

    <div class="form-group">
        <label for="inputTitle">
            Название
        </label>

        <input type="text"
               class="form-control"
               id="inputTitle"
               name="title"
               placeholder="Введите название"
               value="{{ old('title', $news->title) }}"
        >
    </div>

    <div class="form-group">
        <label for="inputDescription">
            Краткое описание
        </label>

        <input type="text"
               class="form-control"
               id="inputDescriptionCreate"
               name="description"
               placeholder="Введите краткое описание"
               value="{{ old('description', $news->description) }}"
        >
    </div>

    <div class="form-group">
        <label for="bodyInput">Текст</label>

        <textarea class="form-control" id="bodyInput" name="body" rows="10">{{ old('body', $news->body) }}</textarea>
    </div>

    <div class="form-group">
        <label for="tagsInput">
            Тэги
        </label>

        <input type="text"
               class="form-control"
               id="tagsInput"
               name="tags"
               placeholder="Тэги"
               value="{{ old('tags', $news->tags->pluck('name')->implode(',')) }}"
        >
    </div>

    <div class="form-check">
        <input class="form-check-input"
               type="checkbox"
               value="1"
               {{ $news->publish ? 'checked' : '' }}
               id="inputPublish"
               name="publish"
        >

        <label class="form-check-label" for="inputPublish">
            Опубликовать
        </label>
    </div>

    <br><br>

    <button type="submit" class="btn btn-primary">{{ $submit }}</button>
</form>
