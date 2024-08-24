<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseRepository implements BaseRepositoryInterface
{

    public Builder $query;

    public function __construct(private readonly Model $model)
    {

        $this->query=$this->model::query();
    }

    public function query(): Builder
    {

        if (empty($this->query)) {
            $this->query = $this->model::query();
        }
        return $this->query;
    }


    public function filterById(int $id, array $relation = []): self
    {
        $this->query = $this->query->where('id', '=', $id)->with($relation);

        return $this;

    }

    public function firstOrFail(): Model
    {
        return $this->query->firstOrFail();
    }

    public function getAll(array $relation = []): Collection
    {
        return $this->query->with($relation)->get();
    }

    public function store(array $data): Model
    {
        return $this->query->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->query->where('id', '=', $id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->query->where('id', '=', $id)->delete();
    }

}
