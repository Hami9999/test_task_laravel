<!DOCTYPE html>
<html>
<head>
    <title>Создать задачу</title>
</head>
<body>

<h1>Создать задачу</h1>

<form method="POST" action="{{ route('tasks.store') }}">
    @csrf

    <div>
        <label>Название:</label><br>
        <input type="text" name="title">
    </div>

    <div>
        <label>Описание:</label><br>
        <textarea name="description"></textarea>
    </div>

    <div>
        <label>Статус:</label><br>
        <select name="status">
            <option value="new">Новая</option>
            <option value="in_progress">В работе</option>
            <option value="done">Выполнена</option>
        </select>
    </div>

    <br>
    <button type="submit">Создать</button>
</form>

</body>
</html>
