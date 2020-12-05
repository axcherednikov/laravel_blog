@component('mail::message')
# Создана новая назадача: {{ $task->title }}

{{ $task->body }}

@component('mail::button', ['url' => route('tasks.show', ['task' => $task->id])])
    Посмотреть задачу
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
