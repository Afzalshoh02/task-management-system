<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Task",
 *     type="object",
 *     required={"id", "title", "status", "priority"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="Fix login bug"),
 *     @OA\Property(property="status", type="string", enum={"todo", "in_progress", "done"}, example="todo"),
 *     @OA\Property(property="priority", type="string", enum={"low", "medium", "high"}, example="high"),
 *     @OA\Property(property="assignee", type="string", example="John Doe"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-04-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-04-01T12:30:00Z")
 * )
 */

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'type',
        'priority',
        'assignee',
        'status'
    ];
    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-y H:i');
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d-m-y H:i');
    }
}
