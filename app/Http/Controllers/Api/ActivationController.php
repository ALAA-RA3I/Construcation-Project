<?php

namespace App\Http\Controllers\Api;

use App\Application\DTO\ActivationDTO\ActivationDTO;
use App\Domain\Services\BaseServices\Contracts\ActivationServiceInterface;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActivationRequest;
use Illuminate\Http\Request;

class ActivationController extends Controller
{
    private $activationService ;
    public function __construct(ActivationServiceInterface $activationService)
    {
        $this->activationService = $activationService;
    }
    public function activate(ActivationRequest $request)
    {
        $data = ActivationDTO::fromActivationRequest($request->validated());
        $isActive = $this->activationService->activate($data);
        if ($isActive){
            return ApiResponse::success('Activation Successfully');
        }
        return ApiResponse::error('Activation Failed');
    }

    public function deactivate(ActivationRequest $request)
    {
        $data = ActivationDTO::fromActivationRequest($request->validated());
        $isDeactivate = $this->activationService->deactivate($data);
        if ($isDeactivate){
            return ApiResponse::success('Deactivation Successfully');
        }
        return ApiResponse::error('Deactivation Failed');
    }
}
