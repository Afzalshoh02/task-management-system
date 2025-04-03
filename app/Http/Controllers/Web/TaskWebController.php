<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TaskWebController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService
    ) {
        $this->middleware('auth');
    }

    public function index(): View
    {
        return view('tasks.index', [
            'tasks' => $this->taskService->getAllTasks(),
            'statusOptions' => ['todo', 'in_progress', 'done'],
            'typeOptions' => ['task', 'story', 'bug'],
            'priorityOptions' => ['low', 'medium', 'high'],
        ]);
    }

    public function create(): View
    {
        return view('tasks.create', [
            'statusOptions' => ['todo', 'in_progress', 'done'],
            'typeOptions' => ['task', 'story', 'bug'],
            'priorityOptions' => ['low', 'medium', 'high'],
        ]);
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $this->taskService->createTask($request->validated());

        return to_route('tasks.index')
            ->with('success', 'Task created successfully');
    }

    public function edit(int $id)
    {
        try {
            $task = $this->taskService->getTask($id);
            return view('tasks.edit', [
                'task' => $task,
                'statusOptions' => ['todo', 'in_progress', 'done'],
                'typeOptions' => ['task', 'story', 'bug'],
                'priorityOptions' => ['low', 'medium', 'high'],
            ]);
        } catch (ModelNotFoundException $e) {
            abort(404, 'Task not found');
        } catch (\Exception $e) {
            abort(500, 'Error retrieving task');
        }
    }

    public function update(TaskRequest $request, int $id)
    {
        try {
            $this->taskService->updateTask($id, $request->validated());
            return to_route('tasks.index')
                ->with('success', 'Task updated successfully');
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Task not found'], 404);
        } catch (\Exception $e) {
            Log::error("Update error: " . $e->getMessage());
            return response()->json(['message' => 'Failed to update task'], 500);
        }
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->taskService->deleteTask($id);

        return to_route('tasks.index')
            ->with('success', 'Task deleted successfully');
    }

    public function updateStatus(UpdateTaskStatusRequest $request, Task $task)
    {
        $task = $this->taskService->changeTaskStatus($task->id, $request->status);

        return response()->json([
            'success' => true,
            'task' => $task,
            'message' => 'Status updated successfully'
        ]);
    }
}
