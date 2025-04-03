<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class TaskRepository implements TaskRepositoryInterface
{
    protected $model;

    public function __construct(Task $task)
    {
        $this->model = $task;
    }

    public function allQuery(): Builder
    {
        return $this->model->newQuery();
    }

    public function all(array $filters = [], int $perPage = null): Collection|LengthAwarePaginator
    {
        $query = $this->allQuery();

        foreach ($filters as $field => $value) {
            if ($value === null) continue;

            switch ($field) {
                case 'assignee':
                case 'title':
                    $query->where($field, 'LIKE', '%' . $value . '%');
                    break;

                case 'created_at_from':
                    $query->where('created_at', '>=', $value);
                    break;

                case 'created_at_to':
                    $query->where('created_at', '<=', $value);
                    break;

                case 'updated_at_from':
                    $query->where('updated_at', '>=', $value);
                    break;

                case 'updated_at_to':
                    $query->where('updated_at', '<=', $value);
                    break;

                default:
                    $query->where($field, $value);
            }
        }

        return $perPage ? $query->paginate($perPage) : $query->get();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $task = $this->find($id);
        $task->update($data);
        return $task;
    }

    public function delete(int $id): bool
    {
        return $this->find($id)->delete();
    }

    public function changeStatus(int $id, string $status)
    {
        $task = $this->find($id);
        $task->status = $status;
        $task->save();
        return $task;
    }
}
