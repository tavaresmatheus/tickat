<?php

namespace App\Repositories;

use App\Repositories\Contracts\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected object $object;

    protected function __construct(object $object)
    {
        $this->object = $object;
    }

    public function listAll(): object
    {
        return $this->object->all();
    }

    public function findById(string $id): ?object
    {
        return $this->object->find($id);
    }

    public function create(array $attributes): object
    {
        return $this->object->create($attributes);
    }

    public function update(
        object $model,
        array $attributes
    ): bool
    {
        return $model->update($attributes);
    }

    public function delete(object $model): bool
    {
        return $model->delete();
    }
}
