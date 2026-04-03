<form method="POST" action="{{ route('tasks.update', $task->id) }}">
    @csrf
    @method('PUT')
    <input type="text" name="title" value="{{ $task->title }}">
    <textarea name="description">{{ $task->description }}</textarea>
    <select name="status">
        <option value="new" {{ $task->status=='new'?'selected':'' }}>Новая</option>
        <option value="in_progress" {{ $task->status=='in_progress'?'selected':'' }}>В работе</option>
        <option value="done" {{ $task->status=='done'?'selected':'' }}>Выполнена</option>
    </select>
    <button type="submit">Сохранить</button>
</form>
