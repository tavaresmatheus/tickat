<?php

namespace App\Http\Controllers;

use App\Businesses\UserBusiness;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    private UserBusiness $userBusiness;

    public function __construct(UserBusiness $userBusiness)
    {
        $this->userBusiness = $userBusiness;
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only(
            'email',
            'password'
        );

        $loginAttempt = Auth::attempt(
            [
                'email' => $credentials['email'],
                'password' => $credentials['password'],
            ]
        );

        $user = $this->userBusiness->findUserByEmail($credentials['email']);

        $token = $user->createToken('auth_token')->plainTextToken;

        if ($loginAttempt === true) {
            return response()->json(
                [
                    'message' => 'Success.',
                    'token' => $token,
                ],
                200
            );
        }

        return response()->json(
            [
                'message' => 'Failed.',
                'token' => 'Invalid credentials.',
            ],
            422
        );
    }

    public function logout(Request $request): JsonResponse
    {
        $token = $request->bearerToken();

        $tokenInformation = PersonalAccessToken::findToken($token);

        $user = $this->userBusiness->findUser($tokenInformation['tokenable_id']);

        $user->tokens()->delete();

        return response()->json(
            [
                'message' => 'Success.',
            ],
            200
        );
    }

    public function register(Request $request): JsonResponse
    {
        $credentials = $request->only(
            'name',
            'email',
            'phone',
            'password'
        );

        $userBusiness = $this->userBusiness->registerUser($credentials);

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
}
