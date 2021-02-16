<form action="{{ route($route, [$modelType => $model->slug], false) }}" method="post">

    @csrf

    <div class="form-group">

        <label for="textareaComment">Комментарий</label>
        <textarea class="form-control form-control-sm" id="textareaComment" rows="3" name="comment">{{ old('comment') }}</textarea>

    </div>

    <button type="submit" class="btn btn-primary btn-sm">Отправить</button>
</form>
