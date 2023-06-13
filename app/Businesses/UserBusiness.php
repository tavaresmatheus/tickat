<?php

namespace App\Businesses;

use App\Businesses\Contracts\UserBusinessInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserBusiness implements UserBusinessInterface
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
    )
    {
        $this->userRepository = $userRepository;
    }

    public function findUser(string $id): ?object
    {
        if (empty($this->userRepository->findById($id))) {
            return null;
        }

        return $this->userRepository->findById($id);
    }

    public function findUserByEmail(string $email): ?object
    {
        return $this->userRepository->findUserByEmail($email);
    }


    public function listAllUsers(): object
    {
        return $this->userRepository->listAll();
    }

    public function registerUser(array $attributes): object
    {
        $validator = Validator::make(
            $attributes,
            [
                'name' => 'required|string|max:255',
                'email' => 'required|email:rfc|unique:users',
                'password' => 'required|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z])(?=.*[a-zA-Z])(?=.*\W).{11,30}$/',
            ],
            [
                'password' => 'Your password must have a number, a lowercase letter, a uppercase letter, a special character and length between 11 to 30 characters.'
            ]
        );

        if ($validator->fails()) {
            return $validator->errors();
        }

        $attributes['password'] = Hash::make($attributes['password']);

        return $this->userRepository->create($attributes);
    }

    public function deleteUser(string $id): bool
    {
        $user = $this->findUser($id);

        if(empty($user)) {
            return false;
        }

        return $this->userRepository->delete($user);
    }

    public function updateUser(
        string $id,
        array $attributes
    ): ?object
    {
        $user = $this->findUser($id);

        if (empty($user)) {
            return null;
        }

        $validator = Validator::make(
            $attributes,
            [
                'name' => 'string|max:255',
                'email' => 'email:rfc|unique:users',
                'password' => 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z])(?=.*[a-zA-Z])(?=.*\W).{11,30}$/',
            ],
            [
                'password' => 'Your password must have a number, a lowercase letter, a uppercase letter, a special character and length between 11 to 30 characters.'
            ]
        );

        if ($validator->fails()) {
            return $validator->errors();
        }

        $this->userRepository->update(
            $user,
            $attributes
        );

        return $this->findUser($id);
    }
}
