<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\Auth\LoginDTO;
use App\Domain\Services\BaseServices\Contracts\AuthServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $data = LoginDTO::fromLoginRequest($request->validated());
        $data = $this->authService->login($data);

        return ApiResponse::success([
            'token' => $data['token'],
            'user'  => new LoginResource($data['user']),
        ]);
    }
}
