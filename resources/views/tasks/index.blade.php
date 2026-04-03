<!DOCTYPE html>
<html>
<head>
    <title>Список задач</title>
</head>
<body>

<h1>Создать задачу</h1>

@if(session('success'))
    <div style="color:green; margin-bottom:20px;">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('tasks.store') }}">
    @csrf

    <div>
        <label>Название:</label><br>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div>
        <label>Описание:</label><br>
        <textarea name="description">{{ old('description') }}</textarea>
        @error('description') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <div>
        <label>Статус:</label><br>
        <select name="status">
            <option value="new" {{ old('status')=='new' ? 'selected' : '' }}>Новая</option>
            <option value="in_progress" {{ old('status')=='in_progress' ? 'selected' : '' }}>В работе</option>
            <option value="done" {{ old('status')=='done' ? 'selected' : '' }}>Выполнена</option>
        </select>
        @error('status') <div style="color:red">{{ $message }}</div> @enderror
    </div>

    <br>
    <button type="submit">Создать</button>
</form>

<hr>

<h2>Все задачи</h2>

@if($tasks->count())
    @foreach($tasks as $task)
        <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
            <h3>{{ $task->title }}</h3>
            <p>{{ $task->description }}</p>
            <p><strong>Статус:</strong> {{ $task->status }}</p>
            <p><strong>Создано:</strong> {{ $task->created_at }}</p>

            <!-- Кнопки действия -->
            <form method="POST" action="{{ route('tasks.destroy', $task->id) }}" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" style="color:red;">Удалить</button>
            </form>

            <form method="GET" action="{{ route('tasks.edit', $task->id) }}" style="display:inline-block;">
                <button type="submit">Редактировать</button>
            </form>

            <form method="GET" action="{{ route('tasks.show', $task->id) }}" style="display:inline-block;">
                <button type="submit">Просмотр</button>
            </form>
        </div>
    @endforeach
@else
    <p>Пока нет задач.</p>
@endif

</body>
</html>
