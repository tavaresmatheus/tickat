<?php

namespace App\Http\Controllers;

use App\Businesses\Contracts\UserBusinessInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected UserBusinessInterface $userBusiness;

    public function __construct(UserBusinessInterface $userBusiness)
    {
        $this->userBusiness = $userBusiness;
    }

    public function listAllUsers(): JsonResponse
    {
        return response()->json(
            [
                'message' => 'Success.',
                'listOfUsers' => $this->userBusiness->listAllUsers(),
            ],
            200
        );
    }

    public function findUser(string $id)
    {
        return response()->json(
            [
                'message' => 'Success.',
                'userDetailed' => $this->userBusiness->findUser($id),
            ],
            200
        );
    }

    public function registerUser(Request $request)
    {
        $userBusiness = $this->userBusiness->registerUser($request->all());

        if (
            $userBusiness instanceof \Illuminate\Support\MessageBag &&
            $userBusiness->isNotEmpty()
        ) {
            return response()->json(
                [
                    'message' => 'Failed.',
                    'validationErrors' => $userBusiness,
                ],
                422
            );
        }

        return response()->json(
            [
                'message' => 'Success.',
                'userRegistered' => $userBusiness,
            ],
            200
        );
    }

    public function deleteUser(string $id)
    {
        $userBusiness = $this->userBusiness->deleteUser($id);

        if ($userBusiness === false) {
            return response()->json(
                [
                    'message' => 'Failed.',
                    'deletionError' => 'User doesn\'t exist.',
                ],
                422
            );
        }

        return response()->json(
            [
                'message' => 'Success.',
                'userDeleted' => "User $id gone."
            ],
            200
        );
    }

    public function updateUser(
        string $id,
        Request $request
    )
    {
        $userBusiness = $this->userBusiness->updateUser(
            $id,
            $request->all()
        );

        if (empty($userBusiness)) {
            return response()->json(
                [
                    'message' => 'Failed.',
                    'updateError' => 'User doesn\'t exist.',
                ],
                422
            );
        }

        if (
            $userBusiness instanceof \Illuminate\Support\MessageBag &&
            $userBusiness->isNotEmpty()
        ) {
            return response()->json(
                [
                    'message' => 'Failed.',
                    'validationErrors' => $userBusiness,
                ],
                422
            );
        }

        return response()->json(
            [
                'message' => 'Success.',
                'updatedUser' => $userBusiness,
            ],
            200
        );
    }
}
