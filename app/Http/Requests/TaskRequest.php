<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @OA\Schema(
 *     schema="TaskRequest",
 *     type="object",
 *     required={"title", "status", "priority", "type", "assignee"},
 *     @OA\Property(property="title", type="string", example="Fix login bug"),
 *     @OA\Property(property="description", type="string", example="Detailed bug description", nullable=true),
 *     @OA\Property(property="type", type="string", enum={"task", "story", "bug"}, example="task"),
 *     @OA\Property(property="priority", type="string", enum={"low", "medium", "high"}, example="high"),
 *     @OA\Property(property="assignee", type="string", example="John Doe"),
 *     @OA\Property(property="status", type="string", enum={"todo", "in_progress", "done"}, example="todo"),
 *     @OA\Property(property="due_date", type="string", format="date", example="2025-04-10", nullable=true)
 * )
 */

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tasks', 'title')->ignore($this->route('task')),
            ],
            'description' => 'nullable|string',
            'type' => 'required|in:task,story,bug',
            'priority' => 'required|in:low,medium,high',
            'assignee' => 'required|string|max:255',
            'status' => 'required|in:todo,in_progress,done',
            'due_date' => 'nullable|date|after:today',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Название обязательно для заполнения',
            'title.unique' => 'Такое название уже существует',
            'type.required' => 'Тип задачи обязателен для заполнения',
            'priority.required' => 'Уровень приоритета обязателен для заполнения',
            'assignee.required' => 'Исполнитель обязателен для заполнения',
            'status.required' => 'Статус обязателен для заполнения',
            'due_date.after' => 'Дата завершения должна быть в будущем',
        ];
    }
}
