<?php

namespace App\Http\Controllers;

use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Helpers\ApiResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\UserResource;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(
        private AuthService $service
    ) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $dto = RegisterDTO::fromArray($request->validated());

        $user = $this->service->register($dto);

        return ApiResponse::success(
            new UserResource($user),
            'User registered successfully',
            Response::HTTP_CREATED
        );
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $dto = LoginDTO::fromArray($request->validated());

        $authData = $this->service->login($dto);

        return ApiResponse::success(
            new AuthResource($authData),
            'User logged in successfully',
            Response::HTTP_OK
        );
    }

    public function logout(): JsonResponse
    {
        $user = request()->user();

        $this->service->logout($user);

        return ApiResponse::success(
            null,
            'Logged out successfully',
            Response::HTTP_OK
        );
    }

    public function me(): JsonResponse
    {
        $user = request()->user();

        return ApiResponse::success(
            new UserResource($user),
            'User retrieved successfully',
            Response::HTTP_OK
        );
    }
}
