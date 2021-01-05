@extends('layout.master')

@section('content')

    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">
            {{ $task->title }}
        </h3>

        @include('tasks.tags', ['tags' => $task->tags])

        {{ $task->body }}

        <br><br>
        <form method="post" action="{{ route('tasks.destroy', ['task' => $task->id], false) }}">

            @csrf
            @method('DELETE')

            <a class="btn btn-primary" href="{{ route('tasks.edit', ['task' => $task->id], false) }}" role="button">Изменить</a>
            <button class="btn btn-danger" type="submit">Удалить</button>

        </form>
        <hr>

        <h4>Шаги выполнения задачи:</h4>
        <br>
        @if($task->steps->isNotEmpty())
            <ul class="list-group">
                @foreach($task->steps as $step)
                    <li class="list-group-item">
                        <form method="post" action="{{ route('completed-steps.store', ['step' => $step->id], false) }}">

                            @if ($step->completed)
                                @method('DELETE')
                            @endif

                            <div class="form-check">
                                @csrf

                                <label class="form-check-label {{ $step->completed ? 'completed' : '' }}">
                                    <input
                                            type="checkbox"
                                            class="form-check-input"
                                            name="completed"
                                            onclick="this.form.submit()"
                                            {{ $step->completed ? 'checked' : '' }}
                                    >
                                    <span>{{ $step->description }}</span>
                                </label>
                            </div>
                        </form>
                        @include('tasks.tags', ['tags' => $step->tags])
                    </li>
                @endforeach
            </ul>
        @endif

        <form class="card card-body mb-4" action="{{ route('steps.store', ['task' => $task->id], false) }}"
              method="POST">
            @csrf

            <div class="form-group">
                <input
                        type="text" class="form-control"
                        placeholder="Шаг" name="description"
                        value="{{ old('description') }}"
                >
                <input
                        type="text" class="form-control"
                        placeholder="Тэги" name="tags"
                        value="{{ old('tags') }}"
                >
            </div>

            <button type="submit" class="btn btn-primary">Отправить</button>
            @include('layout.errors')
        </form>

        <hr>

        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">Email</th>
                <th scope="col">Время изменений</th>
                <th scope="col">До</th>
                <th scope="col">После</th>
            </tr>
            </thead>
            <tbody>
            @forelse($task->history as $item)
                <tr>
                    <th scope="row">{{ $item->email }}</th>
                    <td>{{ $item->pivot->created_at->diffForHumans() }}</td>
                    <td>
                        @foreach(json_decode($item->pivot->before) as $key => $value)
                            <p>{{ $key }} - {{ $value }}</p>
                        @endforeach
                    </td>
                    <td>
                        @foreach(json_decode($item->pivot->after) as $key => $value)
                            <p>{{ $key }} - {{ $value }}</p>
                        @endforeach
                    </td>
                </tr>
            @empty
                <th scope="row">Нет истории изменений</th>
            @endforelse
            </tbody>
        </table>

        <br><br>
        <a href="{{ route('tasks.index', [], false) }}">Вернуться к списку задач.</a>
    </div>

@endsection
