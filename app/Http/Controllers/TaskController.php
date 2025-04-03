<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Services\TaskService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;


/**
 * @OA\Info(
 *     title="Todo API",
 *     version="1.0.0",
 *     description="A simple Todo API built with Laravel"
 * )
 */

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="Get all tasks with filters",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Filter by status",
     *         required=false,
     *         @OA\Schema(type="string", enum={"todo", "in_progress", "done"})
     *     ),
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Filter by type",
     *         required=false,
     *         @OA\Schema(type="string", enum={"task", "story", "bug"})
     *     ),
     *     @OA\Parameter(
     *         name="priority",
     *         in="query",
     *         description="Filter by priority",
     *         required=false,
     *         @OA\Schema(type="string", enum={"low", "medium", "high"})
     *     ),
     *     @OA\Parameter(
     *         name="assignee",
     *         in="query",
     *         description="Filter by assignee name",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Filter by title (partial match)",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Task")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error"
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $tasks = $this->taskService->getAllTasks(request()->query());
            return response()->json($tasks);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve tasks'
            ], 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/tasks",
     *     summary="Create a new task",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Title of the task",
     *         required=true,
     *         @OA\Schema(type="string", example="Fix login bug")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Status of the task",
     *         required=true,
     *         @OA\Schema(type="string", enum={"todo", "in_progress", "done"}, example="todo")
     *     ),
     *     @OA\Parameter(
     *         name="priority",
     *         in="query",
     *         description="Priority of the task",
     *         required=true,
     *         @OA\Schema(type="string", enum={"low", "medium", "high"}, example="high")
     *     ),
     *     @OA\Parameter(
     *          name="type",
     *          in="query",
     *          description="type of the task",
     *          required=true,
     *          @OA\Schema(type="string", enum={"task", "story", "bug"}, example="high")
     *      ),
     *     @OA\Parameter(
     *         name="assignee",
     *         in="query",
     *         description="Assignee name",
     *         required=false,
     *         @OA\Schema(type="string", example="John Doe")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Task created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */

    public function store(TaskRequest $request): JsonResponse
    {
        try {
            $task = $this->taskService->createTask($request->validated());
            return response()->json($task, 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create task'
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     summary="Get a specific task",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     )
     * )
     */
    public function show(int $id): JsonResponse
    {
        try {
            $task = $this->taskService->getTask($id);
            return response()->json($task);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve task'
            ], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{id}",
     *     summary="Update a task",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="title",
     *         in="query",
     *         description="Task title",
     *         required=false,
     *         @OA\Schema(type="string", example="Fix login bug")
     *     ),
     *     @OA\Parameter(
     *         name="description",
     *         in="query",
     *         description="Task description",
     *         required=false,
     *         @OA\Schema(type="string", nullable=true, example="Detailed bug description")
     *     ),
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Task type",
     *         required=true,
     *         @OA\Schema(type="string", enum={"task", "story", "bug"}, example="task")
     *     ),
     *     @OA\Parameter(
     *         name="priority",
     *         in="query",
     *         description="Task priority",
     *         required=true,
     *         @OA\Schema(type="string", enum={"low", "medium", "high"}, example="high")
     *     ),
     *     @OA\Parameter(
     *         name="assignee",
     *         in="query",
     *         description="Assigned person",
     *         required=true,
     *         @OA\Schema(type="string", example="John Doe")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         description="Task status",
     *         required=true,
     *         @OA\Schema(type="string", enum={"todo", "in_progress", "done"}, example="todo")
     *     ),
     *     @OA\Parameter(
     *         name="due_date",
     *         in="query",
     *         description="Due date",
     *         required=false,
     *         @OA\Schema(type="string", format="date", example="2025-04-15")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */

    public function update(TaskRequest $request, int $id): JsonResponse
    {
        try {
            $task = $this->taskService->updateTask($id, $request->validated());
            return response()->json($task);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update task'
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     summary="Delete a task",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Task deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     )
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            $this->taskService->deleteTask($id);
            return response()->json(['message' => 'Task successfully deleted'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete task'
            ], 500);
        }
    }

    /**
     * @OA\Patch(
     *     path="/api/tasks/{id}/status",
     *     summary="Update task status",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="string", enum={"todo", "in_progress", "done"})
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Status updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Task")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function updateStatus(UpdateTaskStatusRequest $request, int $id): JsonResponse
    {
        try {
            $task = $this->taskService->changeTaskStatus($id, $request->status);
            return response()->json($task);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update task status'
            ], 500);
        }
    }
}
