<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface
{
    public function listAll(): object;

    public function findById(string $id): object;

    public function create(array $attributes): object;

    public function update(
        string $id,
        array $attributes
    ): bool;

    public function delete(string $id): bool;
}