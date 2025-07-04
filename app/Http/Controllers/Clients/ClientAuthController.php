<?php

namespace App\Http\Controllers\Clients;

use App\Application\DTO\Auth\LoginDTO;
use App\Application\DTO\ClientsDTO\changePasswordDTO;
use App\Domain\Services\BaseServices\Contracts\ClientAuthServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\ClientRequests\PasswordRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Http\Request;

class ClientAuthController extends Controller
{
    protected $clientService;

    public function __construct(ClientAuthServiceInterface $clientService)
    {
        $this->clientService = $clientService;
    }

    public function login(LoginRequest $request) {
        $validatedData = LoginDTO::fromLoginRequest($request->validated());
        $data = $this->clientService->login($validatedData);

        return ApiResponse::success([
            'token' => $data['token'],
        ]);
    }

    public function changePassword(PasswordRequest $request,$id) {
        $validatedData = changePasswordDTO::fromChangeRequest($request->validated());
        $this->clientService->changePassword($validatedData,$id);
        return ApiResponse::success(null,'password changed Successfully');
    }
}
