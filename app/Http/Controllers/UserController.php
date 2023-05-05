<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function listAllUsers()
    {
        return response(
            $this->userRepository->listAll(),
            200
        );
    }

    public function findUser(string $id)
    {
        return response(
            $this->userRepository->findById($id),
            200
        );
    }

    public function registerUser(Request $request)
    {
        return response(
            $this->userRepository->create($request->all()),
            200
        );
    }

    public function deleteUser(string $id)
    {
        return response(
            $this->userRepository->delete($id),
            200
        );
    }

    public function updateUser(
        string $id,
        Request $request
    )
    {
        return response(
            $this->userRepository->update(
                $id,
                $request->all()
            )
        );
    }
}
