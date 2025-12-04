<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\User\UserService;

class RegisterController extends Controller
{
    public function __construct(private UserService $userService) {}

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Http\Requests\Register  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->userService->create($request->toDTO());

        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'User registered successfully',
            'user' => new UserResource($user),
            'token' => $token,
        ], 201);
    }
}
