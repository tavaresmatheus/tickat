<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    public function listAll(): object;

    public function findById(string $id): ?object;

    public function create(array $attributes): object;

    public function update(
        object $model,
        array $attributes
    ): bool;

    public function delete(object $model): bool;
}
