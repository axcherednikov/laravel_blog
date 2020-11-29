<div class="form-group">
    <label for="inputSlug">URL статьи</label>

    <input type="text"
           class="form-control"
           id="inputSlug"
           name="slug"
           placeholder="Введите URL статьи"
           value="{{ old('slug', $post->slug ?? '') }}"
    >

    <small id="slugHelp" class="form-text text-muted">
        URL должен быть уникальным для всего сайта, или оставьте данное поле пустым оно сгенерируется
        автоматически
    </small>
</div>

<br>

<div class="form-group">
    <label for="inputTitle">Название статьи</label>

    <input type="text"
           class="form-control"
           id="inputTitle"
           name="title"
           placeholder="Введите название статьи"
           value="{{ old('title', $post->title ?? '') }}"
    >
</div>

<div class="form-group">
    <label for="inputDescription">
        Краткое описание статьи
    </label>

    <input type="text"
           class="form-control"
           id="inputDescriptionCreate"
           name="description"
           placeholder="Введите краткое описание"
           value="{{ old('description', $post->description ?? '') }}"
    >

</div>

<div class="form-group">
    <label for="bodyInput">Текст статьи</label>

    <textarea class="form-control" id="bodyInput" name="body" rows="10">
                    {{ old('body', $post->body ?? '') }}
                </textarea>
</div>

<div class="form-group">
    <label for="tagsInput">Тэги</label>
    <input type="text"
           class="form-control"
           id="tagsInput"
           name="tags"
           placeholder="Тэги статьи"
           value="{{ old('tags', isset($post) ? $post->tags->pluck('name')->implode(',') : '') }}"
    >
</div>

<div class="form-check">
    <input class="form-check-input"
           type="checkbox"
           value="1"
           {{ isset($post->publish) && $post->publish ? 'checked' : '' }}
           id="inputPublish"
           name="publish"
    >

    <label class="form-check-label" for="inputPublish">
        Опубликовать статью
    </label>
</div>

<br><br>

