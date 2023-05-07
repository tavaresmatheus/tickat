<?php

namespace App\Businesses\Contracts;

interface UserBusinessInterface
{
    public function findUser(string $id): ?object;

    public function listAllUsers(): object;

    public function registerUser(array $attributes): object;

    public function deleteUser(string $id): bool;

    public function updateUser(
        string $id,
        array $attributes
    ): ?object;
}