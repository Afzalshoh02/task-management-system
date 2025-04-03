<?php

namespace App\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

interface TaskRepositoryInterface
{
    public function all(array $filters = [], int $perPage = null): Collection|LengthAwarePaginator;
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id): bool;
    public function changeStatus(int $id, string $status);
    public function allQuery(): Builder;
}
