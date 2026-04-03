<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// главная страница = список задач
Route::get('/', [TaskController::class, 'index']);

// полный CRUD
Route::resource('tasks', TaskController::class);
