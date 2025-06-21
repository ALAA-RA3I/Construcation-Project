<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\Auth\LoginDTO;
use App\Domain\Services\BaseServices\Contracts\AuthServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function myPermissions(Request $request)
    {
        $user = Auth::user();
        $data = $this->authService->getAuthenticatedUserPermissions($user);
        return ApiResponse::success($data);
    }
}
