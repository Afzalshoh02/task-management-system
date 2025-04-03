<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_all_tasks()
    {
        Task::factory()->count(3)->create();
        $response = $this->getJson('/api/tasks');
        $response->assertStatus(200)
            ->assertJsonCount(3)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'title',
                    'description',
                    'type',
                    'priority',
                    'assignee',
                    'status',
                    'created_at',
                    'updated_at'
                ]
            ]);
    }

    /** @test */
    public function it_can_create_a_task()
    {
        $taskData = [
            'title' => 'New Task',
            'description' => 'Task description',
            'type' => 'task',
            'priority' => 'medium',
            'assignee' => 'John Doe',
            'status' => 'todo'
        ];

        $response = $this->postJson('/api/tasks', $taskData);

        $response->assertStatus(201)
            ->assertJsonFragment($taskData);

        $this->assertDatabaseHas('tasks', $taskData);
    }

    /** @test */
    public function it_validates_task_creation()
    {
        $response = $this->postJson('/api/tasks', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['title', 'type', 'priority', 'assignee', 'status']);
    }

    /** @test */
    /** @test */
    public function it_can_show_a_task()
    {
        $task = Task::factory()->create();

        $response = $this->getJson("/api/tasks/{$task->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'type' => $task->type,
                'priority' => $task->priority,
                'assignee' => $task->assignee,
                'status' => $task->status,
            ]);
    }

    /** @test */
    public function it_returns_404_for_nonexistent_task()
    {
        $response = $this->getJson('/api/tasks/9999');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_can_update_a_task()
    {
        $task = Task::factory()->create();

        $updateData = [
            'title' => 'Updated Task',
            'description' => 'Updated description',
            'type' => $task->type,
            'priority' => 'high',
            'assignee' => $task->assignee,
            'status' => 'in_progress'
        ];

        $response = $this->putJson("/api/tasks/{$task->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'Updated Task',
                'priority' => 'high',
                'status' => 'in_progress'
            ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Task',
            'priority' => 'high',
            'status' => 'in_progress'
        ]);
    }

    /** @test */
    public function it_can_update_task_status()
    {
        $task = Task::factory()->create(['status' => 'todo']);
        $updateData = ['status' => 'in_progress'];

        $response = $this->patchJson("/api/tasks/{$task->id}/status", $updateData);

        $response->assertStatus(200)
            ->assertJsonFragment(['status' => 'in_progress']);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'in_progress'
        ]);
    }

    /** @test */
    public function it_validates_task_status_update()
    {
        $task = Task::factory()->create();

        $response = $this->patchJson("/api/tasks/{$task->id}/status", [
            'status' => 'invalid_status'
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['status']);
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
