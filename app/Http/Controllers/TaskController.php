<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    // 📄 Список задач
  public function index(Request $request)
  {
      $query = Task::query();

      // Фильтр по статусу
      if ($request->has('status') && $request->status != '') {
          $query->where('status', $request->status);
      }

      // Поиск по названию
      if ($request->has('search') && $request->search != '') {
          $query->where('title', 'like', '%' . $request->search . '%');
      }

      // Пагинация (10 задач на страницу)
      $tasks = $query->latest()->paginate(10);

      return view('tasks.index', compact('tasks'));
  }

public function store(StoreTaskRequest $request)
{

    \App\Models\Task::create($request->validated());

    return redirect()->route('tasks.index')
                     ->with('success', 'Задача создана!');
}
 public function update(StoreTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        return redirect()->route('tasks.index')
                         ->with('success', 'Задача обновлена!');
    }

    // 🗑 Удаление задачи
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
                         ->with('success', 'Задача удалена!');
    }

    // 🔍 Просмотр одной задачи
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }
public function edit(Task $task)
{
    return view('tasks.edit', compact('task'));
}
}
