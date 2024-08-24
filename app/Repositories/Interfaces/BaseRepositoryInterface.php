<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    public function filterById(int $id, array $relation = []): self;
    public function query(): Builder;
    public function firstOrFail():Model;
    public function getAll(array $relation = []): Collection;
    public function store(array $data): Model;
    public function update(int $id, array $data): bool;
    public function delete(int $id);
}
