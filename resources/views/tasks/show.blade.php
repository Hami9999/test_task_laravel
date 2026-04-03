<!DOCTYPE html>
<html>
<head>
    <title>Просмотр задачи</title>
</head>
<body>

<h1>{{ $task->title }}</h1>

<p><strong>Описание:</strong></p>
<p>{{ $task->description }}</p>

<p><strong>Статус:</strong> {{ $task->status }}</p>

<p><strong>Создано:</strong> {{ $task->created_at }}</p>
<p><strong>Обновлено:</strong> {{ $task->updated_at }}</p>

<br>
<a href="{{ route('tasks.index') }}">← Вернуться к списку задач</a>

</body>
</html>
