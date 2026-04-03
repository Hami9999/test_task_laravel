<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// Главная страница = список задач с формой создания
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

// Ресурсный CRUD, но исключаем create и edit
Route::resource('tasks', TaskController::class);
