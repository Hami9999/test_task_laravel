<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Разрешаем всем (можешь ограничить по необходимости)
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3',
            'description' => 'nullable|string',
            'status' => 'required|in:new,in_progress,done',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Поле Название обязательно',
            'title.min' => 'Название должно быть минимум 3 символа',
            'status.required' => 'Поле Статус обязательно',
            'status.in' => 'Выбран недопустимый статус',
        ];
    }
}
