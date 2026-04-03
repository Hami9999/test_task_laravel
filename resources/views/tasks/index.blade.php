<!DOCTYPE html>
<html>
<head>
    <title>Список задач</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 20px auto;
            line-height: 1.6;
        }
        h1, h2 {
            color: #333;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], textarea, select {
            width: 100%;
            padding: 6px 10px;
            margin-top: 4px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
        }
        button.delete {
            background-color: #f44336;
            color: white;
        }
        button.edit {
            background-color: #2196F3;
            color: white;
        }
        button.show {
            background-color: #ff9800;
            color: white;
        }
        .task {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .task-actions form {
            display: inline-block;
            margin-right: 5px;
        }
        .success-message {
            color: green;
            margin-bottom: 20px;
        }
        .error-message {
            color: red;
        }

        /* Improved pagination */
        .pagination {
            display: flex;
            list-style: none;
            gap: 4px;
            padding: 0;
            margin-top: 10px;
        }
        .pagination li a, .pagination li span {
            display: inline-block;
            min-width: 30px;
            padding: 4px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            font-size: 13px;
            color: #333;
        }
        .pagination li span {
            background-color: #eee;
            font-weight: bold;
        }
        .pagination li a:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>

<h1>Создать задачу</h1>

@if(session('success'))
    <div class="success-message">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('tasks.store') }}">
    @csrf
    <div>
        <label>Название:</label>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title') <div class="error-message">{{ $message }}</div> @enderror
    </div>

    <div>
        <label>Описание:</label>
        <textarea name="description">{{ old('description') }}</textarea>
        @error('description') <div class="error-message">{{ $message }}</div> @enderror
    </div>

    <div>
        <label>Статус:</label>
        <select name="status">
            <option value="new" {{ old('status')=='new' ? 'selected' : '' }}>Новая</option>
            <option value="in_progress" {{ old('status')=='in_progress' ? 'selected' : '' }}>В работе</option>
            <option value="done" {{ old('status')=='done' ? 'selected' : '' }}>Выполнена</option>
        </select>
        @error('status') <div class="error-message">{{ $message }}</div> @enderror
    </div>

    <button type="submit">Создать</button>
</form>

<hr>

<section>
    <h2>Фильтр и поиск</h2>
    <form method="GET" action="{{ route('tasks.index') }}">
        <input type="text" name="search" placeholder="Поиск по названию" value="{{ request('search') }}">
        <select name="status">
            <option value="">Все статусы</option>
            <option value="new" {{ request('status')=='new' ? 'selected' : '' }}>Новая</option>
            <option value="in_progress" {{ request('status')=='in_progress' ? 'selected' : '' }}>В работе</option>
            <option value="done" {{ request('status')=='done' ? 'selected' : '' }}>Выполнена</option>
        </select>
        <button type="submit">Применить</button>
    </form>
</section>

<hr>

<section>
    <h2>Все задачи</h2>

    @if($tasks->count())
        @foreach($tasks as $task)
            <div class="task">
                <h3>{{ $task->title }}</h3>
                <p>{{ $task->description }}</p>
                <p><strong>Статус:</strong> {{ $task->status }}</p>
                <p><strong>Создано:</strong> {{ $task->created_at }}</p>

                <div class="task-actions">
                    <form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete">Удалить</button>
                    </form>

                    <form method="GET" action="{{ route('tasks.edit', $task->id) }}">
                        <button type="submit" class="edit">Редактировать</button>
                    </form>

                    <form method="GET" action="{{ route('tasks.show', $task->id) }}">
                        <button type="submit" class="show">Просмотр</button>
                    </form>
                </div>
            </div>
        @endforeach

        <!-- Пагинация -->
        <div>
            {{ $tasks->withQueryString()->links() }}
        </div>

    @else
        <p>Пока нет задач.</p>
    @endif
</section>

</body>
</html>
