<?php

namespace App\Services;

use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class TaskService
{
    protected TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getAllTasks(array $filters = [], int $perPage = null): Collection|LengthAwarePaginator
    {
        try {
            return $this->taskRepository->all($filters, $perPage);
        } catch (\Exception $e) {
            Log::error("Failed to get tasks: " . $e->getMessage());
            throw new \RuntimeException('Failed to retrieve tasks');
        }
    }

    public function getTask(int $id)
    {
        try {
            return $this->taskRepository->find($id);
        } catch (ModelNotFoundException $e) {
            Log::warning("Task not found: {$id}");
            throw $e;
        } catch (\Exception $e) {
            Log::error("Failed to get task {$id}: " . $e->getMessage());
            throw new \RuntimeException('Failed to retrieve task');
        }
    }

    public function createTask(array $data)
    {
        try {
            $task = $this->taskRepository->create($data);
            if (request()->wantsJson() || request()->is('api/*')) {
                return $task;
            }
            return response()->json(['success' => true], 201);
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error("Failed to create task: " . $e->getMessage());
            throw new \RuntimeException('Failed to create task');
        }
    }

    public function updateTask(int $id, array $data)
    {
        try {
            return $this->taskRepository->update($id, $data);
        } catch (ModelNotFoundException $e) {
            Log::warning("Task not found for update: {$id}");
            throw $e;
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error("Failed to update task {$id}: " . $e->getMessage());
            throw new \RuntimeException('Failed to update task');
        }
    }

    public function deleteTask(int $id): bool
    {
        try {
            return $this->taskRepository->delete($id);
        } catch (ModelNotFoundException $e) {
            Log::warning("Task not found for deletion: {$id}");
            throw $e;
        } catch (\Exception $e) {
            Log::error("Failed to delete task {$id}: " . $e->getMessage());
            throw new \RuntimeException('Failed to delete task');
        }
    }

    public function changeTaskStatus(int $id, string $status): Model
    {
        try {
            return $this->taskRepository->changeStatus($id, $status);
        } catch (ModelNotFoundException $e) {
            Log::warning("Task not found for status change: {$id}");
            throw $e;
        } catch (\Exception $e) {
            Log::error("Failed to change status for task {$id}: " . $e->getMessage());
            throw new \RuntimeException('Failed to change task status');
        }
    }
}
